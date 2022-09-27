## How to contribute

### Git-Related

#### **Did you find a bug?** / **Do you want to suggest something?**

* Create an issue at [this issue page](https://github.com/MisterPeModder/Bomberman-Global-Offensive/issues).

#### **Do you want to create a branch?**

* Your branch name should be formatted as `fix/<ISSUENUMBER>-<TITLE>` for bug fixes or `feature/<ISSUENUMBER>-<TITLE>` for features, example: `fix/4221-infinite-loop`.

#### **Do you want to fix an issue?**

* Create a branch

* Implement your features of fixes in it.

* Submit a [pull request](https://github.com/MisterPeModder/Bomberman-Global-Offensive/pulls).

* Once validated, merge to PR to `master` and remove the source branch (with `git branch -D <branch_name>`.

#### **How to title commits?**

* Follow the guidelines at https://cbea.ms/git-commit/

* Use imperative tense (avoid past tense).

* The title of the commit must be a summuary of the content and not be too long (less than 50 characters).

* Prefer putting detailed informations inside the commit's description.

* Example:
  ```sh
  $> git commit -m 'Fix infinite loop when pressing Alt-F4
  
  This was caused by a missing check in the event loop
  The program now checks when the window is set to close'
  ```

***

### Code Documentation

* PHP: Follow the [PHPDoc syntax](https://docs.phpdoc.org/3.0/guide/references/phpdoc/index.html)

* JS: Use the [JSDoc syntax](https://www.typescriptlang.org/docs/handbook/jsdoc-supported-types.html) (with TypeScript types).

* Example (PHP):
  ```php
  /**
   * Short brief line.
   *
   * More in-depth description (optional)
   *
   * @param int parameter1 Parameter description.
   */
  function someFunction(int $parameter1): string {
    // ...
  }
  ```
  
***

### Coding Style

* PHP: The format to use is the [PSR-12 Extended Coding Style](https://www.php-fig.org/psr/psr-12/).

***

### **DOs and DONTs**

* :x: **DONT**: Push to the `master` (or `main`) branch for any reason, please submit a PR instead.

* :x: **DONT**: Create a branch with your username as the title

* :heavy_check_mark: **DO**: Commit often! allows everyone to see your progress and eventually make suggestions on it.

* :heavy_check_mark: **DO**: Format your code using your IDE's capabilities (and yes, VSCode can format your code for you!)


***

Thanks! :heart: :heart: :heart:
