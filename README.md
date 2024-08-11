# Gitflow

## Branches Overview

### Main Branches

- **`main`**: This branch contains the finished code
- **`develop`**: This branch serves as the parent branch for features and fixes

### Additional Branches

- **Feature Branch**
  - **Purpose**: To develop new features or make changes.
  - **Name**: `feature/island-encoder`
  - **Example**: `feature/user-authentication`
  - **Commands**:
    ```sh
    # Create a new feature branch from develop
    git checkout -b feature/island-encoder develop
    
    # Merge the feature branch into develop
    git checkout develop
    git merge feature/island-encoder
    
    # Delete the feature branch
    Locally:
    git branch -d feature/island-encoder
    Remotely:
    git push origin --delete feature/island-encoder
    ```

- **Release Branch**
  - **Purpose**: Used for final testing and bug fixes before merging into `main` branch.
  - **Naming Convention**: `release/version-number` (btw you can change the version-number)
  - **Example**: `release/1.0.0`
  - **Commands**:
    ```sh
    # Create a new release branch from develop
    git checkout -b release/version-number develop
    
    # Merge the release branch into main and develop
    git checkout main
    git merge release/version-number
    git checkout develop
    git merge release/version-number
    
    # Delete the release branch
    Locally:
    git branch -d release/version-number
    Remotely:
    git push origin --delete release/version-number
    ```

- **Hotfix Branch**
  - **Purpose**: To quickly address urgent issues in the production code. Created from `main` and merged back into both `main` and `develop`.
  - **Naming Convention**: `hotfix/issue-description`
  - **Example**: `hotfix/fix-login-bug`
  - **Commands**:
    ```sh
    # Create a new hotfix branch from main
    git checkout -b hotfix/issue-description main
    
    # Merge the hotfix branch into main and develop so urgent fixes are consistently applied across all project branches
    git checkout main
    git merge hotfix/issue-description
    git checkout develop
    git merge hotfix/issue-description
    
    # Delete the hotfix branch
    Locally:
    git branch -d hotfix/issue-description
    Remotely:
    git push origin --delete hotfix/issue-description
    ```

## Workflow

1. **Feature Development**:
   - Create a feature branch from `develop` for new features.
   - Work on the feature and test it.
   - Merge the feature branch into `develop` when complete.
   - Delete the feature branch locally and remotely.

2. **Release Preparation**:
   - Create a release branch from `develop` when ready to prepare for a new release.
   - Perform final testing and make any necessary bug fixes.
   - Merge the release branch into `main` and `develop`.
   - Delete the release branch locally and remotely.

3. **Hotfixes**:
   - Create a hotfix branch from `main` to address urgent issues in production.
   - Merge the hotfix branch into both `main` and `develop`.
   - Delete the hotfix branch locally and remotely.

## Notes
this is just what gitflow looks lie via a diagram
- Follow the naming conventions for clarity and consistency.
- Always sync with `develop` and `main` branches before creating new branches.

By following this Gitflow schema, we can maintain a structured workflow and ensure that our codebase remains organized and stable throughout the development lifecycle.
