<script>
    function fcGetLaborAppropriationRow(id, row) {

        document.getElementById("labor_appropriation_id").value = id;
        document.getElementById("employee_role_id").value = row.employee_role_id;
        document.getElementById("hours").value = row.hours;
        document.getElementById("rate").value = row.rate;

        document.getElementById("employee_role_id").focus();

        document.getElementById("btnSaveLaborAppropriation").style.display = "none";
        document.getElementById("btnUpdateLaborAppropriation").style.display = "";
        document.getElementById("btnCancelLaborAppropriation").style.display = "";

    }


    function fcCancelLaborRow() {

        document.getElementById("labor_appropriation_id").value = '';
        document.getElementById("employee_role_id").value = '';
        document.getElementById("hours").value = '';
        document.getElementById("rate").value = '';

        document.getElementById("btnSaveLaborAppropriation").style.display = "";
        document.getElementById("btnUpdateLaborAppropriation").style.display = "none";
        document.getElementById("btnCancelLaborAppropriation").style.display = "none";

    }

    </script>
