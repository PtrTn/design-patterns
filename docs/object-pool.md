# Usage
Use the object pool pattern when:
- You have a service that's expensive to create (e.g. database connection or instance of an application)
- You have to re-use that service
- (Optionally) you need to use multiple instances of that service at the same time
- (Optionally) there's a maximum of services that you want use at the same time (e.g. due to CPU or connection limitations)

# Implementation
- Implement a Pool class that's responsible for holding and creating instances of the re-usable service
- Whenever a new service is requested make sure to return any available existing services before creating a new one
- After using a reusable service, make sure to 'release' it for further usage elsewhere
