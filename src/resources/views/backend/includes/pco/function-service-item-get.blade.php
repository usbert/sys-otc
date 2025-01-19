<script>
    function fcGetServiceItemRow(id, indx) {

        document.getElementById("service_item_id").value = id;

        const str = document.getElementById("colSI-A-"+indx+"").innerText;
        const chars = str.split('.');
        document.getElementById("level_01").value = chars[0].trim();
        document.getElementById("level_02").value = chars[1];

        document.getElementById("item_description").value = document.getElementById("colSI-B-"+indx+"").innerText;
        document.getElementById("item_cost").value = document.getElementById("colSI-C-"+indx+"").innerText;
        document.getElementById("item_cost").focus();


        document.getElementById("btnSaveSI").style.display = "none";
        document.getElementById("btnUpdateSI").style.display = "";
        document.getElementById("btnCancelSI").style.display = "";

    }
    </script>
