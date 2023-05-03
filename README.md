# PackageTemplate
A template repository for making composer packages


## What's Included

- [PHPUnit](https://phpunit.de/)
- [PHP CodeSniffer](https://github.com/squizlabs/PHP_CodeSniffer)
- GitHub Actions
- Composer Commands
  - `composer phpunit` - Run PHPUnit tests
  - `composer phpunit-coverage` - Run PHPUnit tests with coverage
  - `composer cs` - Run PHP CodeSniffer
  - `composer csfix` - Run PHP CodeSniffer and fix errors

## How to set up?

1. Clone this repository and remove the `.git` folder
2. Run `composer install`
3. Run `git init` to initialize a new git repository
4. Run `git add .` to add all files to the repository
5. Run `git commit -m "Initial commit"` to commit the files
6. Create a new repository on GitHub
7. Run `git remote add origin <url>` to add the new repository as remote
8. Run `git push -u origin master` to push the files to the new repository
9. Update the `README.md` file
10. Update the `composer.json` file
11. Update the `LICENSE` file
12. Update the `phpunit.xml` file