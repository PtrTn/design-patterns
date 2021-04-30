# Usage
Use the adapter pattern when:
- The interface of a service or entity does not fit your needs
- The desired interface can still be matched back to the original interface

# Implementation
- For entities you'll have to either write a wrapper or a static constructor accepting the original entity as argument
- For services you can write a wrapper service with the desired interface, which internally converts method calls to the original interface  
