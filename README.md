# Senior Software Engineer Tech Challenge 2022

## Challenge
Using the GitHub API. We want to create a leaders board for contributors to a repository:
- As a user, I can list my repositories.
- As a user, I can select a repository from the list
- As a user, I can see the list of users by their username, count PR reviews, count PRs.
    - The table is ordered by the number of PRs the user reviewed.
    - Contain only last month stats (the duration should be easily changeable)

| Username        | Reviewed PRs           | Opened PRs  |
| ------------- |:-------------:| -----:|
| amine      | 30 | 12 |

Below are important points to be present in the solution:
- Unit tests.
- CI/CD using GitHub action on push to master.
- Backoff strategy implementation when communicating with GitHub API.
- Application architecture is to be considered. (Separated service, encapsulation, clean API).
- Consider the rate limitation of the GitHub API.

NOTE: Don’t use a PHP package for the GitHub API calls.