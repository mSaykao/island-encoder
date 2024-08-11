# island-encoder
mandurphy

Create:

On VSC terminal, clone github repo to vsc, create a local features, version, hotfix branch from which will be created in the develop branch
e.g. All team members do these Command*

git checkout develop

git pull origin develop

git checkout -b feature/mathias // create and switch to the feature branch

git add . //commits stages

git commit -m "Add feature: hello" // this is just a message

Push Feature Branch to Develop:

git push origin feature/mathias


Merge:

git checkout develop

git pull origin develop

git merge feature/mathias

git push origin develop

Delete:

git branch -d feature/feature-name

git push origin --delete feature/feature-name

What do they do?

Creating Branches: Keep your work separate from the main code.

Merging Branches: Combine your new code with the main code after testing.

Deleting Branches: Removes old branches that are not needed



