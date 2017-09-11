(function (VideoHelper) {
    var supportWideScreen = true;
    //private var
    var isFireFox = navigator.userAgent.toLowerCase().indexOf('firefox') > -1;
    var callType = 1;
    //public static func
    VideoHelper.rotateVideo = function (videoElementId, degree) {
        var videoContainerId = $("#" + videoElementId).parent().attr("id");
        _setRotation($("#" + videoElementId), degree, function () {
            VideoHelper.optimizeVideo(videoContainerId);
        });
    }

    VideoHelper.isRotated = function (element) {
        if (!element) {
            return false;
        }
        var elementStyle;
        if (isFireFox) {
            elementStyle = element.style.MozTransform;
        }
        else {
            elementStyle = element.style["-webkit-transform"];
        }

        return elementStyle.indexOf("rotate(90deg)") >= 0 || elementStyle.indexOf("rotate(2700deg)") >= 0;
    }

    VideoHelper.mirrorVideo = function (videoElementId) {
        document.getElementById(videoElementId).style.WebkitTransform += " scaleX(-1)";
    }

    VideoHelper.moveVideoFromMainToNewWindow = function (showVideo, filter, callback) {
        var isLocalVideo = _isLocalContainer($("#mainVideoContainer"));
        var $mainVideo = $("#mainVideoContainer video");
        var mainVideoStream = $mainVideo.attr("src");
        var mainVideoId = $mainVideo.attr("id").replace("vid_", "");
        var mainDName = $("#name_" + mainVideoId).text();
        _getRotation(mainVideoId, function (mainVideoRotation) {
            _createVideoContainer(mainVideoId, function ($container) {
                _createVideoElement(mainVideoId, mainVideoStream, isLocalVideo, showVideo, filter, function ($vid) {
                    _setRotation($vid, mainVideoRotation, function ($vid) {
                        $vid.appendTo($container);
                        $vid.on("canplaythrough", function () {
                            VideoHelper.optimizeVideosAfterWindowsChanged();
                        });
                        if (!_isLocalContainer($container)) {
                            _createControllBar(mainVideoId, showVideo, function ($controll) {
                                $controll.appendTo($container);
                            });
                        }
                        $container.appendTo("#remoteVideos");
                        callback();
                    });
                });

                _createDisplayNameContainer(mainVideoId, mainDName, function ($dNameContainer) {
                    //$dNameContainer.appendTo($container);
                });
            });
        });
    }

    VideoHelper.addNewParticipantToMainWindow = function (uId, dName, stream) {
        $("#mainVideoContainer").html("");
        _createVideoElement(uId, stream, false, false, "none", function ($vid) {
            $vid.appendTo("#mainVideoContainer");
            $vid.on("canplaythrough", function () {
                VideoHelper.optimizeVideosAfterWindowsChanged();
            });
            _createControllBar(uId, false, function ($controll) {
                $controll.appendTo("#mainVideoContainer");
            });
            _createDisplayNameContainer(uId, dName, function ($dNameContainer) {
                // $dNameContainer.appendTo("#mainVideoContainer");
            });
        });

        _muteStreamIfSpeakersMuted();
    }

    VideoHelper.removeParticipantThatlLeft = function (uId) {
        var $leftVid = $("#vid_" + uId);
        if ($leftVid.parent().attr("id") == "mainVideoContainer") {
            var $remoteVideos = $(".videoContainer");
            var $containerToShowInMain = $remoteVideos.last();
            var participantToShowInMain = $containerToShowInMain.attr('id').replace("container_", "");
            var dNameToShowInMain = $("#name_" + participantToShowInMain).text();
            var $videoToShowInMain = $("#vid_" + participantToShowInMain);
            var streamToShowInMain = $videoToShowInMain.attr("src");
            var isLocalVideo = _isLocalContainer($containerToShowInMain);
            var showVideo = $videoToShowInMain.is(":visible");
            var filterToShowInMain = VideoHelper.getFilter(participantToShowInMain);

            _getRotation(participantToShowInMain, function (rotation) {
                _moveParticipantToMainWindow(participantToShowInMain, dNameToShowInMain, streamToShowInMain, isLocalVideo, showVideo, rotation, filterToShowInMain);
                $("#container_" + participantToShowInMain).hide('slow', function () {
                    $("#container_" + participantToShowInMain).remove();
                    VideoHelper.optimizeVideosAfterWindowsChanged();
                });
            });
        }
        else {
            $leftVid.parent().hide('slow', function () {
                $leftVid.parent().remove();
                VideoHelper.optimizeVideosAfterWindowsChanged();
            });
        }

        
    }

    VideoHelper.optimizeVideo = function (videoContainerId) {
        if (!supportWideScreen) {
            var videoContainer = document.getElementById(videoContainerId);
            if (_isLocalContainer(videoContainer)) {
                var videoElement = videoContainer.firstElementChild;
                if (!videoElement) {
                    return;
                }
                videoElement.style.WebkitTransform += " scaleX(-1)";
                videoElement.style.MozTransform += " scaleX(-1)";
            }
        } else {
            _optimizeVideo(videoContainerId);
        }
    }

    VideoHelper.optimizeVideosAfterWindowsChanged = function () {
        setTimeout(function () {
            _optimizeVideosAfterWindowsChanged();
            setTimeout(function () { _optimizeVideosAfterWindowsChanged(); }, 300);
        }, 150);
    }

    VideoHelper.showInMainContainer = function (video_Id, event) {
        if (isFireFox) { return; }
        var $clickedContainer = $("#container_" + video_Id);
        var $selectedVideo = $("#vid_" + video_Id);
        var selectedDName = $("#name_" + video_Id).text();
        var selectedVideoStream = $selectedVideo.attr("src");
        var showSelectedVideo = $selectedVideo.is(":visible");
        var selectedFilter = VideoHelper.getFilter(video_Id);

        var $mainContainer = $("#mainVideoContainer");
        var $mainVideo = $($mainContainer.find("video")[0]);
        var mainVideoId = $mainVideo.attr('id').replace("vid_", "");
        var mainDname = $("#name_" + mainVideoId).text();
        var mainVideoStream = $mainVideo.attr("src");
        var showMainVideo = $mainVideo.is(":visible")
        var mainFilter = VideoHelper.getFilter(mainVideoId);

        _getRotation(video_Id, function (rotation) {
            _getRotation(mainVideoId, function (rotationMain) {
                var isClickedContainerLocal = _isLocalContainer($clickedContainer);
                var isMainContainerLocal = _isLocalContainer($mainContainer);
                _moveParticipantToMainWindow(video_Id, selectedDName, selectedVideoStream, isClickedContainerLocal, showSelectedVideo, rotation, selectedFilter);
                _moveParticipantToOtherWindow(mainVideoId, mainDname, mainVideoStream, isMainContainerLocal, showMainVideo, $clickedContainer, rotationMain, mainFilter);
            });
        });

        _ignoreOtherEvents(event);
    }

    VideoHelper.setCallType = function (numOfParticipants) {
        if (numOfParticipants > 5) {
            callType = VideoHelper.CallType.MORE_THAN_FIVE_WAY;
        }
        else {
            callType = numOfParticipants;
        }
    }

    VideoHelper.drawCallWindows = function (numOfParticipants, mainVideoContainer, remoteVideosContainer) {
        VideoHelper.setCallType(numOfParticipants);
        switch (callType) {
            case VideoHelper.CallType.PREVIEW:
            case VideoHelper.CallType.TWO_WAY:
            default:
                _drawTwoWayWindows(mainVideoContainer, remoteVideosContainer);
                break;
            case VideoHelper.CallType.THREE_WAY:
                _drawThreeWayWindows(mainVideoContainer, remoteVideosContainer);
                break;
            case VideoHelper.CallType.FOUR_WAY:
                _drawFourWayWindows(mainVideoContainer, remoteVideosContainer);
                break;
            case VideoHelper.CallType.FIVE_WAY:
            case VideoHelper.CallType.MORE_THAN_FIVE_WAY:
                _drawMoreThanFourWayWindows(mainVideoContainer, remoteVideosContainer);
                break;
        }
    }

    VideoHelper.setFilter = function (uid, filter) {
        if ($("#vid_" + uid).hasClass("localVideo")) {
            filter += " localVideo";
        }

        $("#vid_" + uid).removeClass();
        $("#vid_" + uid).addClass(filter);
    }

    VideoHelper.getFilter = function (uid) {
        var filter = $("#vid_" + uid + "[class^='filter-'],#vid_" + uid + "[class*=' filter-']");
        if (filter && filter.length > 0) {
            var classList = filter[0].classList;
            for (var i = 0; i < classList.length; i++) {
                if (classList[i].indexOf('filter') >= 0) {
                    return classList[i];
                }
            }
        }
        else {
            return "none";
        }
    }

    //public enum
    VideoHelper.CallType = { "PREVIEW": 1, "TWO_WAY": 2, "THREE_WAY": 3, "FOUR_WAY": 4, "FIVE_WAY": 5, "MORE_THAN_FIVE_WAY": 6 };

    //private func
    function _createVideoContainer(vidId, callback) {
        var $newContainer = $("<div id=\"container_" + vidId + "\" class=\"videoContainer\" ondblclick = \"VideoHelper.showInMainContainer(" + "'" + vidId + "'" + ",event)\"></div>");
        if (callType == VideoHelper.CallType.THREE_WAY) {
            $newContainer.css({ bottom: '', top: '0' });
        }
        if (callType == VideoHelper.CallType.FOUR_WAY) {
            var $remoteVideos = $("#remoteVideos").children();
            $($remoteVideos[0]).css({ left: '', right: '0' });
            $($remoteVideos[1]).css({ left: '', right: '0' });
            $newContainer.css({ left: '0', right: '' });
        }

        callback($newContainer);
    }

    function _createVideoElement(vidId, stream, isLocalVideo, showVideo, filter, callback) {
        var $vid;
        if (isLocalVideo) {
            $vid = $("<video id=\"vid_" + vidId + "\" autoplay muted class='localVideo " + filter + "' src=" + stream + " ></video>");
        }
        else {
            $vid = $("<video id=\"vid_" + vidId + "\" autoplay class=" + filter + " src=" + stream + " ></video>");
        }
        if (showVideo) {
            $vid.show();
        }
        else {
            $vid.hide();
        }

        callback($vid);
    }

    function _createDisplayNameContainer(vidId, dName, callback) {
        //var $nameContainer = $("<div id=\"name_" + vidId + "\" class=\"displayname\" title=\"" + dName + "\">" + dName + "</div>");
        //callback($nameContainer);
        callback();
    }

    function _createControllBar(vidId, showVideo, callback) {
        var $controllBar = $("<div id=\"control_" + vidId + "\" class=\"remote_control_bar\"></div>");
        var $camDiv = $("<div></div>");
        if (showVideo) {
            $camDiv.removeClass().addClass("icon cam left10");
            $camDiv.attr("onclick", "stopRemote(event, \"" + vidId +"\")");
        }
        else {
            $camDiv.removeClass().addClass("icon cam left10 cam_stopped");
            $camDiv.attr("onclick", "startRemote(event, \"" + vidId + "\")");
        }
        var $div = $("<div></div>");
        $camDiv.appendTo($div);
        $div.appendTo($controllBar);
        var $leftDiv = $("<div class=\"left200\"></div>");
        var $endCallDiv = $("<div class=\"icon disconnect\" onclick=\"conf.disconnect();\"></div>")
        $endCallDiv.appendTo($leftDiv)
        $leftDiv.appendTo($controllBar)
        callback($controllBar);
    }

    function _optimizeVideo(videoContainerId) {
        var $videoContainer = $("#" + videoContainerId);
        if (!$videoContainer) {
            return;
        }

        var isLocalVideo = _isLocalContainer($videoContainer);

        var $videoElement = $videoContainer.children().first();
        if (!$videoElement) {
            return;
        }

        var borderLength = 0;

        if ($videoContainer.hasClass("videoContainer")) {
            borderLength = window.getComputedStyle($videoContainer[0], null).getPropertyValue("border-left-width").replace("px", "");
        }

        var containerHeightNotInculdeBorders = $videoContainer[0].offsetHeight - (2 * borderLength);

        var heightDelta = ((containerHeightNotInculdeBorders - $videoElement[0].offsetHeight) / 2);

        var containerWidthNotInculdeBorders = $videoContainer[0].offsetWidth - (2 * borderLength);

        var widthDelta = ((containerWidthNotInculdeBorders - $videoElement[0].offsetWidth) / 2);

        var zoomRatio = (containerWidthNotInculdeBorders / $videoElement[0].offsetWidth);

        if (zoomRatio < 1) {
            zoomRatio = 1;
        }

        _getRotation($videoElement.attr("id").replace("vid_", ""), function (rotation) {
            if (_isPortaritMode($videoElement, rotation)) {
                zoomRatio = (containerHeightNotInculdeBorders / $videoElement[0].offsetHeight);
            }
            if (isLocalVideo) {
                $videoElement.css({ '-webkit-transform': 'rotate(' + rotation + 'deg) scale(' + zoomRatio + ') scaleX(-1)', '-moz-transform': 'rotate(' + rotation + 'deg) scale(' + zoomRatio + ') scaleX(-1)' });
            }
            else {
                $videoElement.css({ '-webkit-transform': 'rotate(' + rotation + 'deg) scale(' + zoomRatio + ')', '-moz-transform': 'rotate(' + rotation + 'deg) scale(' + zoomRatio + ')' });
            }
        });

        $videoElement.css({ "marginTop": (heightDelta).toString() + "px" });
        $videoElement.animate({ "marginLeft": (widthDelta).toString() + "px" }, "fast");


    }

    function _optimizeVideosAfterWindowsChanged() {
        var $videosList = $(".videoContainer");
        switch (callType) {
            case VideoHelper.CallType.PREVIEW:
                VideoHelper.optimizeVideo("mainVideoContainer");
                break;
            case VideoHelper.CallType.TWO_WAY:
                VideoHelper.optimizeVideo("mainVideoContainer");
                VideoHelper.optimizeVideo($($videosList[0]).attr("id"));
                break;
            case VideoHelper.CallType.THREE_WAY:
                VideoHelper.optimizeVideo("mainVideoContainer");
                VideoHelper.optimizeVideo($($videosList[0]).attr("id"));
                VideoHelper.optimizeVideo($($videosList[1]).attr("id"));
                
                if (!_isLocalContainer($($videosList[0]))) {
                    $($videosList[0]).css({ left: '', right: '0', bottom: '', top: '0' });
                    $($videosList[1]).css({ left: '', right: '0', bottom: '0', top: '' });
                }
                else {
                    $($videosList[0]).css({ left: '', right: '0', bottom: '0', top: '' });
                    $($videosList[1]).css({ left: '', right: '0', bottom: '', top: '0' });
                }
                break;
            case VideoHelper.CallType.FOUR_WAY:
                VideoHelper.optimizeVideo("mainVideoContainer");
                VideoHelper.optimizeVideo($($videosList[0]).attr("id"));
                VideoHelper.optimizeVideo($($videosList[1]).attr("id"));
                VideoHelper.optimizeVideo($($videosList[2]).attr("id"));
                $($videosList[0]).css({ left: '', right: '0', bottom: '0', top: '' });
                $($videosList[1]).css({ left: '', right: '0', bottom: '', top: '0' });
                $($videosList[2]).css({ left: '0', right: '', bottom: '0', top: '' });
                break;
            case VideoHelper.CallType.FIVE_WAY:
                VideoHelper.optimizeVideo("mainVideoContainer");
                VideoHelper.optimizeVideo($($videosList[0]).attr("id"));
                VideoHelper.optimizeVideo($($videosList[1]).attr("id"));
                VideoHelper.optimizeVideo($($videosList[2]).attr("id"));
                VideoHelper.optimizeVideo($($videosList[3]).attr("id"));
                break;
        }
    }

    function _drawTwoWayWindows(mainVideoContainer, remoteVideosContainer) {
        mainVideoContainer.removeAttribute("class");
        mainVideoContainer.setAttribute("class", "two_wayMainVideoContainer  in_call");

        remoteVideosContainer.removeAttribute("class");
        remoteVideosContainer.setAttribute("class", "two_wayRemoteVideosContainer");
    }

    function _drawThreeWayWindows(mainVideoContainer, remoteVideosContainer) {
        mainVideoContainer.removeAttribute("class");
        mainVideoContainer.setAttribute("class", "three_wayMainVideoContainer in_call");

        remoteVideosContainer.removeAttribute("class");
        remoteVideosContainer.setAttribute("class", "three_wayRemoteVideosContainer");
    }

    function _drawFourWayWindows(mainVideoContainer, remoteVideosContainer) {
        mainVideoContainer.removeAttribute("class");
        mainVideoContainer.setAttribute("class", "four_wayMainVideoContainer in_call");
        remoteVideosContainer.removeAttribute("class");
        remoteVideosContainer.setAttribute("class", "four_wayRemoteVideosContainer");
    }

    function _drawMoreThanFourWayWindows(mainVideoContainer, remoteVideosContainer) {
        mainVideoContainer.removeAttribute("class");
        mainVideoContainer.setAttribute("class", "five_wayMainVideoContainer  in_call");

        remoteVideosContainer.removeAttribute("class");
        remoteVideosContainer.setAttribute("class", "five_wayRemoteVideosContainer");
    }

    function _moveParticipantToMainWindow(uId, dName, stream, isLocalVideo, showVideo, rotation, filter) {
        var $mainContainer = $("#mainVideoContainer");
        $mainContainer.html("");
        _createVideoElement(uId, stream, isLocalVideo, showVideo, filter, function ($vid) {
            _setRotation($vid, rotation, function ($vid) {
                $vid.appendTo("#mainVideoContainer");
                if (!_isLocalContainer($mainContainer)) {
                    _createControllBar(uId, showVideo, function ($controll) {
                        $controll.appendTo("#mainVideoContainer");
                    });
                }
                _createDisplayNameContainer(uId, dName, function ($dNameContainer) {
                    //$dNameContainer.appendTo("#mainVideoContainer");
                });
            });
        });

    }

    function _moveParticipantToOtherWindow(uId, dName, stream, isLocalVideo, showVideo, $destinationContainer, rotation, filter) {
        $destinationContainer.html("");
        $destinationContainer.attr("id", "container_" + uId);
        $destinationContainer.attr("ondblclick", "VideoHelper.showInMainContainer("+ "'" + uId + "'" + ",event)");
        _createVideoElement(uId, stream, isLocalVideo, showVideo, filter, function ($vid) {
            _setRotation($vid, rotation, function ($vid) {
                $vid.appendTo($destinationContainer)
                if (!_isLocalContainer($destinationContainer)) {
                    _createControllBar(uId, showVideo, function ($controll) {
                        $controll.appendTo($destinationContainer)
                    });
                }
                VideoHelper.optimizeVideosAfterWindowsChanged();// ($destinationContainer.attr('id'));
            });

            _createDisplayNameContainer(uId, dName, function ($dNameContainer) {
                //$dNameContainer.appendTo($destinationContainer);
            });
        });

    }

    function _setRotation($vid, rotation, callback) {
        if (isNaN(rotation)) {
            callback($vid);
            return;
        }
        $vid.css({ '-webkit-transform': 'rotate(' + rotation + 'deg)', '-moz-transform': 'rotate(' + rotation + 'deg)' });
        callback($vid);
    }

    function _getRotation(vid, callback) {
        var $videoObj = $("#vid_" + vid);
        var isLocal = $videoObj.hasClass("localVideo");
        var matrix = $videoObj.css("-webkit-transform") ||
        $videoObj.css("-moz-transform") ||
        $videoObj.css("-ms-transform") ||
        $videoObj.css("-o-transform") ||
        $videoObj.css("transform");
        if (matrix && matrix !== 'none') {
            var values = matrix.split('(')[1].split(')')[0].split(',');
            var a = values[0];
            var b = values[1];
            if (isLocal && a < 0) {
                a = a * (-1);
            }
            var angle = Math.round(Math.atan2(b, a) * (180 / Math.PI));
        } else { var angle = 0; }

        callback(angle);
    }

    function _isLocalContainer($videoContainer) {
        return $($($videoContainer).find("video")[0]).hasClass("localVideo");
    }

    function _muteStreamIfSpeakersMuted() {
        if (ooVoo.API.Conference.getRemoteAudioMute()) {
            ooVoo.API.Conference.setRemoteAudioMute(true);
        }
    }

    function _isPortaritMode($videoElement, rotation) {
        return (($videoElement[0].offsetWidth > $videoElement[0].offsetHeight) && (rotation == 90 || rotation == -90));
    }

    function _ignoreOtherEvents(event) {
        if (!event) var event = window.event;
        event.cancelBubble = true;
        if (event.stopPropagation) {
            event.stopPropagation()
        }
    }

})(window.VideoHelper = window.VideoHelper || {});