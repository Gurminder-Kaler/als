<?php
use App\Models\User;

function isAdmin() {
    if (Auth::check() == true) {
        return (Auth::user()->role == "admin");
    } else {
        return redirect('/');
    }
}

?>
