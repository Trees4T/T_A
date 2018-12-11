<script>

function addField (argument) {
        var myTable = document.getElementById("more-mu");
        var currentIndex = myTable.rows.length;
        var currentRow = myTable.insertRow(-1);

        //untuk looping berapa kali sesuai panjang table
        var forinput = document.getElementById("forinput");
        forinput.setAttribute("value", currentIndex);
      

        var mu = document.createElement("input");
        mu.setAttribute("type", "text");
        mu.setAttribute("class", "form-control ");
        mu.setAttribute("name", "mu" + currentIndex);

        var type_trees = document.createElement("input");
        type_trees.setAttribute("type", "number");
        type_trees.setAttribute("class", "form-control");
        type_trees.setAttribute("name", "type_trees" + currentIndex);

        var total_trees = document.createElement("input");
        total_trees.setAttribute("type", "text");
        total_trees.setAttribute("class", "form-control");
        total_trees.setAttribute("name", "total_trees" + currentIndex);

        var available = document.createElement("input");
        available.setAttribute("type", "text");
        available.setAttribute("class", "form-control price");
        available.setAttribute("name", "available" + currentIndex);

        var deleterow = document.createElement("button");
        deleterow.setAttribute("id", "delete"+currentIndex);
        deleterow.setAttribute("value", "delete");
        deleterow.setAttribute("class", "btn btn-danger");
        deleterow.setAttribute("onclick", "deleteRow"+currentIndex+"(this)");
        deleterow.innerHTML='X';


       // ------------ //

        var currentCell = currentRow.insertCell(-1);
        currentCell.appendChild(mu);

        currentCell = currentRow.insertCell(-1);
        currentCell.appendChild(type_trees);

        currentCell = currentRow.insertCell(-1);
        currentCell.appendChild(total_trees);

        currentCell = currentRow.insertCell(-1);
        currentCell.appendChild(available);

        currentCell = currentRow.insertCell(-1);
        currentCell.appendChild(deleterow);
    }

    function deleteRow (r){
    var i = r.parentNode.parentNode.rowIndex;
    document.getElementById("table-bahanbaku").deleteRow(i);
}
<?php
  for($i=1;$i<100;$i++)
  {
?>

  function deleteRow<?php echo $i ?> (r){
      var i = r.parentNode.parentNode.rowIndex;
      document.getElementById("table-bahanbaku").deleteRow(i);
  }
<?php  
}
?>


</script>