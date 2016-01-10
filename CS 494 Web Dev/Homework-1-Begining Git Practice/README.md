Assignment-Intro-to-Git
=======================

The basics of Git usage

## Overview

In this assignment you will demonstrate your ability to use basic Git functionality to clone this repository, make changes to a file on the master branch, make a feature branch, merge the feature branch, roll back a commit.

## Instructions

1. ~~[Fork](https://help.github.com/articles/fork-a-repo) this repository into your GitHub account.~~ Add a file to your your personal team repository in the OSU-CS494-F14 organizaiton (username-Student should be the name of the repo that is auto generated). You should be able to automatially join this organization via [this site hacked together by your instructor](http://idyllic-aspect-573.appspot.com/). Test this early because it is a little held together with [duct tape](http://i.imgur.com/QnZ3XBa.jpg).
  - If you don't want to use GitHub, for this assignment, you may use Git on the Engineering Server but it will be your responsibility to get permissions se up correctly.
2. _Add_ a file called bio.md. This should be a simple, plain text document. If you want to add [fancy formatting](https://help.github.com/articles/markdown-basics) you are welcome to do so.
3. _Commit_ this to your repository that will be turned in.
4. Add some basic  to your bio. Things like hobbies and interests that you want to share.
5. Add a header for a section on _programming background_ (but don't add content).
5. _Commit_ those changes.
6. Make a branch called _programming-bio_.
7. Make at least two commits in this branch adding information about your programming background in the _programming background_ section. This can be things like your favorite project in 161/162 or any other programming work you have done.
8. Switch back to your _master_ branch. 
9. Add more info to your bio and commit that change.
10. Merge the _programming background_ branch with your _master_ branch.
11. Add some more content.
12. _Commit_ that content.
13. Make a _branch_ off the 2nd to last commit called _rewriting-the-future_. Make a change there and commit it.
14. Push all of this to a Git repo the instructor can assess. (Probably your repo in the class organization)

## Final Product

You should have a commit history with the following content:

- Two commits
- A branch off of the 2nd commit called _programming-bio_
  - This branch should have at least 2 commits
- At least one commit after this in _master_
- A commit merging _master_ and _programming-bio_
- At least one commit following that merge
- A branch created after the last commit on master that points to the 2nd to last commit on the master branch. This branch should have 1 commit.

## Grading

The grading will be based on the extent to which the above instructions are followed. If you deviate from the instructions, you will potentially lose points. Even if you think you are 'improving' something.

### Getting an A

This is a bit non-typical as it is not a proper coding assignment. To move from a B to an A, I would suggest doing one or more of the following _on a branch off of the final master commit_. (Everything up to the final _master_ commit should conform to the above requirements)
- Learn to use the GitHub issue system. Open, assign and close an issue.
- Work with someone else. Get some one else to check out and make changes to your repo and you should do the same to their repo.
- Do the same thing again, but use a different version control system and write a short paragraph talking about the differences.
- Intentionally get yourself into a situation that requires merging conflicting work (merging edits to the same lines). Figure out how to correctly merge the content and document the steps you took to do so.
