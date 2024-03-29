/*
 * FeedEk jQuery RSS/ATOM Feed Plugin v1.1.2
 * http://jquery-plugins.net/FeedEk/FeedEk.html
 * Author : Engin KIZIL
 * http://www.enginkizil.com
 */
(function (e) {
    e.fn.FeedEk = function (t) {
        var n = {
            FeedUrl: "http://rss.cnn.com/rss/edition.rss",
            MaxCount: 5,
            ShowDesc: true,
            ShowPubDate: true,
            CharacterLimit: 0,
            TitleLinkTarget: "_blank"
        };
        if (t) {
            e.extend(n, t)
        }
        var r = e(this).attr("id");
        var i;
        e("#" + r).empty().append('');
        e.ajax({
            url: "//ajax.googleapis.com/ajax/services/feed/load?v=1.0&num=" + n.MaxCount + "&output=json&q=" + encodeURIComponent(n.FeedUrl) + "&hl=en&callback=?",
            dataType: "json",
            success: function (t) {
                e("#" + r).empty();
                var s = "";
                e.each(t.responseData.feed.entries, function (e, t) {
                    s += '<li class="m-b-10"><span class="itemTitle"><a href="' + t.link + '" target="' + n.TitleLinkTarget + '" >' + t.title + "</a></span>";
                    if (n.ShowPubDate) {
                        i = new Date(t.publishedDate);
                        s += '<small class="itemDate text-muted m-l-10">' + i.toLocaleDateString() + "</small>"
                    }
                    if (n.ShowDesc) {
                        if (n.DescCharacterLimit > 0 && t.content.length > n.DescCharacterLimit) {
                            s += '<div class="itemContent">' + t.content.substr(0, n.DescCharacterLimit) + "...</div>"
                        } else {
                            s += '<div class="itemContent">' + t.content + "</div>"
                        }
                    }
                });
                e("#" + r).append('<ul class="feedEkList list-unstyled">' + s + "</ul>")
            }
        })
    }
})(jQuery)