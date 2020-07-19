const FilterEtudiant = () =>{
    var input, filter, table, tr, td, i,j, txtValue;
        input = document.getElementById("search-txt");
        filter = input.value.toUpperCase();
        table = document.getElementById("tableEtudiants");
        tr = table.getElementsByTagName("tr");
        // Loop through all table rows, and hide those who don't match the search query
        for (i = 1; i < tr.length; i++) {
            // Hide the row initially.
            tr[i].style.display = "none";
            
            td = tr[i].getElementsByTagName("td");
            for (var j = 0; j < td.length; j++) {
              cell = tr[i].getElementsByTagName("td")[j];
              if (cell) {
                if (cell.innerHTML.toUpperCase().indexOf(filter) > -1) {
                  tr[i].style.display = "";
                  break;
                } 
              }
            }
        }   
}
 
const FilterEnseignant = () =>{
    var input, filter, table, tr, td, i,j, txtValue; 
        input = document.getElementById("search-txt");
        filter = input.value.toUpperCase();
        table = document.getElementById("tableEnseignants");
        tr = table.getElementsByTagName("tr");
        // Loop through all table rows, and hide those who don't match the search query
        for (i = 1; i < tr.length; i++) {
            // Hide the row initially.
            tr[i].style.display = "none";

            td = tr[i].getElementsByTagName("td");
            for (var j = 0; j < td.length; j++) {
              cell = tr[i].getElementsByTagName("td")[j];
              if (cell) {
                if (cell.innerHTML.toUpperCase().indexOf(filter) > -1) {
                  tr[i].style.display = "";
                  break;
                } 
              }
            }
        }   
}

const FilterAdministrateur = () =>{
    var input, filter, table, tr, td, i,j, txtValue;
        input = document.getElementById("search-txt");
        filter = input.value.toUpperCase();
        table = document.getElementById("tableAdministrateurs");
        tr = table.getElementsByTagName("tr");
        // Loop through all table rows, and hide those who don't match the search query
        for (i = 1; i < tr.length; i++) {
            // Hide the row initially.
            tr[i].style.display = "none";

            td = tr[i].getElementsByTagName("td");
            for (var j = 0; j < td.length; j++) {
              cell = tr[i].getElementsByTagName("td")[j];
              if (cell) {
                if (cell.innerHTML.toUpperCase().indexOf(filter) > -1) {
                  tr[i].style.display = "";
                  break;
                } 
              }
            }
        }   
}