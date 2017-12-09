var exampleResultArray = [
    {
        "timestamp": 150892000,
        "headline": "New version of the product announced.",
        "link": "http://example.url/new_version",
        "authorName": "Paul Abbot",
        "authorImageUrl": "http://example.url/authors/abbot.jpg"
    },
    {
        "timestamp": 150892600,
        "headline": "Even newer version of the product announced.",
        "link": "http://example.url/newer_version",
        "authorName": "Lisa Halliday",
        "authorImageUrl": "http://example.url/authors/halliday.jpg"
    }
];
// sort the array in descending order
exampleResultArray.sort(function(a, b){return b.timestamp-a.timestamp});
var output = '';
for(var i = 0;i < exampleResultArray.length;i++){
    output += 'Array No:'+ i +'<li>Timestamp'+exampleResultArray[i].timestamp+'</li>'+
    '<li>Headline:'+exampleResultArray[i].headline+'</li>'+
    '<li>Source:'+exampleResultArray[i].link+'</li>'+
    '<li>Author Name:'+exampleResultArray[i].authorName+'</li>'+
    '<li>Image Url:'+exampleResultArray[i].authorImageUrl+'</li>&nbsp;';
}
document.getElementById('exampleResultArray').innerHTML = output;

/*
* If we add source file connection in below code it will read and show the data.
*/
/*
var xhttp = new XMLHttpRequest();
xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        var response = JSON.Parse(xhttp.responseText);
        // sort the array in descending order
        exampleResultArray.sort(function(a, b){return b.timestamp-a.timestamp});
        var output = '';
        for(var i = 0;i < exampleResultArray.length;i++){
            output += 'Array No:'+ i +'<li>Timestamp'+exampleResultArray[i].timestamp+'</li>'+
                '<li>Headline:'+exampleResultArray[i].headline+'</li>'+
                '<li>Source:'+exampleResultArray[i].link+'</li>'+
                '<li>Author Name:'+exampleResultArray[i].authorName+'</li>'+
                '<li>Image Url:'+exampleResultArray[i].authorImageUrl+'</li>&nbsp;';
        }
        document.getElementById('exampleResultArray').innerHTML = output;
    }
};
xhttp.open("GET", "source.json", true);
xhttp.send();

*/