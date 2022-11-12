<?php
  
// FORMATTING FUNCTION
function html_escape($text): string
{
    // Return escaped string
    return htmlspecialchars($text, ENT_QUOTES, 'UTF-8', false); 
}

 // Convert to DateTime object
function format_date(string $string): string
{
    $date = date_create_from_format('Y-m-d H:i:s', $string);   
    return $date->format('F d, Y');                             
}


// Convert errors to exceptions
set_error_handler('handle_error');
function handle_error($error_type, $error_message, $error_file, $error_line)
{
    throw new ErrorException($error_message, 0, $error_type, $error_file, $error_line); 
}

// Custom header() function: Create query string// Create new path// Redirect to new page// Stop code
function redirect(string $location, array $parameters = [], $response_code = 302)
{
    $qs = $parameters ? '?' . http_build_query($parameters) : '';  
    $location = $location . $qs;                                   
    header('Location: ' . $location, $response_code);              
    exit;                                                          
}

?>