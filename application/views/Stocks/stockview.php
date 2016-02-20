<!--On click handler for the drop down menu, redirects the page to the corresponding stock-->
<script>
    function stock_onclick() {
        var url =document.getElementById("stocklist").value;
        location.href = '/stock/picked_stocks/' + url;
    }
    
</script>
<!--The drop down menu-->
<h1>This is the Stock page</h1>

{pageselect}


{stocktable}

<br />
<br />

{movementtable}
        
       


<!--The stock movements table-->


