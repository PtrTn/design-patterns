# Usage
Use the builder pattern when:
- You're creating multiple similar objects with a shared step-by-step creation flow
- Or you're creating a complex object and want to prevent it from getting a big constructor

# Alternatives
See if the constructor argument list can be split up into value objects or parameter objects.
Then use a factory to create the initial object and sub-factories for each of the value/parameter objects if needed.

# Implementation
1. Create at least two objects which will be created step-by-step using setters 
2. Create a builder interface which defines all steps in the creation flow
3. Implement a builder per object created in step 1, which implements the interface from step 2
4. (Optional) Create a director which is responsible for coordinating the step-by-step flow 
