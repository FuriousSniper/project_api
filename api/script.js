function request(inp,query){
    //options to fetch request
    var opts = {
        method: 'GET',      
        headers: {}
    };
    //url, where API is
    var url = new URL("http://localhost/api/collection.php"),
    //parameters, which we send to api: option is based on what we want to do: add, delete, etc.
    // query is a user's input
    params = {option:inp, query:query}
    //parsing parameters and adding them to URL (GET)
    Object.keys(params).forEach(key => url.searchParams.append(key, params[key]))
    
    //connecting to API via fetch
    fetch(url, opts).then(function (response) {
        return response.json();
    })
    //retrieving results and displaying them in chosen div
    .then(function (body) {
        document.getElementById("results").innerHTML=body.result
        console.log(body)
    });
    
}
//adding event listeners to each of 4 buttons
var buttons=document.getElementsByClassName("fetch")
for (var i = 0; i < buttons.length; i++) {
    buttons[i].addEventListener("click",function(){
        //after click, the function gets input's custom data tag as well as query, which is retrieved from input with the same id as data-inp.
        var inp=this.getAttribute("data-inp");
        //a little workaround for last button, where input does not exist (because it's useless)
        if(inp!="distinct")
            var query=document.getElementById(inp).value
        else
            var query=inp
        //we don't do anything if user didn't type anything
        if(query==""){
            alert("Query cannot be null!")
        }
        //if input isn't null, we execute fetch
        else{
            request(inp,query)
        }
    })
}
