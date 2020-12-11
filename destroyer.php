<?php
//function to destroy session
function destroy()
{
    session_start();
    session_unset();
    session_destroy();
}
