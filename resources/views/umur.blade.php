<?php
    function umur($tgl_lahir) {
        $today = new DateTime();
        $lahir = new DateTime($tgl_lahir);

        $diff = $today->diff($lahir);

        return $diff->y;
    }
?>