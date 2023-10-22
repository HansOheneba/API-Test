def solution(s):
    while len(s) > 1:
        longest_palindrome = ""

        # Iterate through all prefixes of the string
        for i in range(len(s)):
            prefix = s[:i + 1]

            # Check if the prefix is a palindrome and longer than the current longest
            if prefix == prefix[::-1] and len(prefix) > len(longest_palindrome):
                longest_palindrome = prefix

        # If the longest palindrome has at least two characters, cut it from the string
        if len(longest_palindrome) >= 2:
            s = s[len(longest_palindrome):]
        else:
            # If the longest palindrome has less than two characters, end the algorithm
            break

    return s

# Test cases
print(solution("aaacodedoc"))  
print(solution("codesignal"))  
print(solution("racecar"))            
print(solution("noon"))            
print(solution("deified"))            
print(solution("level"))            
print(solution("rotor"))            
print(solution("programming"))            
print(solution("madam"))            
print(solution("civic"))            
print(solution("test"))            
print(solution("aba"))            
