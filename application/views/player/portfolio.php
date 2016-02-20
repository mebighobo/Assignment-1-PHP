<script>
    function player_redirect() {
        var url =document.getElementById("playerlist").value;
        location.href = '/player/portfolio/' + url;
    }
    
</script>
<div class="row">
  <div class="col-md-2">Players: </div>
  <div class="col-md-4">
{select_players}
  </div>
</div>
<div class="row">
    <div class="col-md-6">
        <img width ="100" height = "100" src ={image} />
    </div>
    <div class="col-md-6">

        <dl>
            <dt>Name</dt>
            <dd>{name}</dd>
            
            <dt>Cash</dt>
            <dd>{cash}</dd>
        </dl>
        
    </div>
</div>

<div class="row">
    {transactions}
</div>