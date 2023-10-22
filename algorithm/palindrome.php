<?php

function solution($s) {
    while (strlen($s) > 1) {
        $longestPalindrome = "";

        // Iterate through all prefixes of the string
        for ($i = 0; $i < strlen($s); $i++) {
            $prefix = substr($s, 0, $i + 1);

            // Check if the prefix is a palindrome and longer than the current longest
            if (isPalindrome($prefix) && strlen($prefix) > strlen($longestPalindrome)) {
                $longestPalindrome = $prefix;
            }
        }

        // If the longest palindrome has at least two characters, cut it from the string
        if (strlen($longestPalindrome) >= 2) {
            $s = substr($s, strlen($longestPalindrome));
        } else {
            // If the longest palindrome has less than two characters, end the algorithm
            break;
        }
    }

    return $s;
}

// check if a string is a palindrome
function isPalindrome($str) {
    return $str === strrev($str);
}

// Tests
echo solution("aaacodedoc"). "<br>";    
echo solution("codesignal"). "<br>";   
echo solution(""). "<br>";             
echo solution("racecar"). "<br>";        
echo solution("noon"). "<br>";           
echo solution("deified"). "<br>";        
echo solution("level"). "<br>";          
echo solution("rotor"). "<br>";          
echo solution("programming"). "<br>";    
echo solution("algorithm"). "<br>";     
echo solution("madam"). "<br>";          
echo solution("civic"). "<br>";          
echo solution("test"). "<br>";         
echo solution("a"). "<br>";           
echo solution("ab"). "<br>";             
echo solution("abb"). "<br>";     
echo solution(""). "<br>";               
