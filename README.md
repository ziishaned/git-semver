# git-semver

[![Build Status](https://travis-ci.org/zeeshanu/git-semver.svg?branch=master)](https://travis-ci.org/zeeshanu/git-semver)
[![Latest Version](https://img.shields.io/github/release/zeeshanu/git-profile.svg?style=flat-square)](https://github.com/zeeshanu/git-profile/releases)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)

> A CLI tool to generate [semantic versioning](http://semver.org) compliant tags for your git repositories. 

## Install

* Download the file from [here](https://github.com/zeeshanu/git-semver/releases/download/v1.0.0/git-semver)
* Assign required permissions `sudo chmod -R 755 git-semver`
* Run `sudo mv git-semver /usr/local/bin/git-semver`

## Usage

Below is the signature for command

```shell
$ git semver <patch|minor|major> [options]
```

Where `patch`, `minor` or `major` specifies the type of release that you are about to make.

- `patch` use this option when you make backwards-compatible bug fixes
- `minor` use this option when you add functionality in a backwards-compatible manner
- `major` use this option when you make incompatible API changes

### Options

In addition to the type of release i.e. `patch`, `major` or `minor`, you can add following options to modify the behavior of command

- `--fetch` Fetch the remote tags before applying the version (Recommended)
- `--prefix` Prefix to prepend to the tag e.g. `--prefix=v` to prepend `v` i.e. for tags similar to `v1.0.1`
- `--postfix` Append to the tag e.g `--postfix="-live"` to append `-live` to generate tags similar to `1.2.3-live`


## Examples

Find some of the usage examples below

### Tag Examples

- Below command creates a patch release i.e. increment the last part of the tag by 1 e.g. it will generate `x.y.1`, if the last tag was `x.y.0`

```shell
$ git semver patch
```

- Below command creates a minor release i.e. middle part of the tag will be incremented e.g. if the last tag was `x.2.z` then it will become `x.3.z`

```shell
$ git semver minor
```

- Below command will create a major release i.e. the first part of the tag will be incremented e.g. if the last tag was `0.y.z` then it will become `1.y.z`

```shell
$ git semver major
```

### Fetching Remote Tags

If you would want to fetch the remote tags before creating the tag, then use the `--fetch` option. For example

```shell
$ git semver patch --fetch
```

Above command will make sure that the remote tags are fetched before creating a new tag. On a sidenote, it is recommended to add this flag e.g. if you are working in a team it is quite possible that you might not have some tag locally and creating a tag without fetching might end up in duplicated tags.

### Prefix and Postfix Usage

1. Prefix
	If you want to create a release while prefixing some keyword e.g. `v` then you can provide that using `--prefix` option. For example:
 
 ```shell
 $ git semver patch --prefix=v
 ```

The above command will generate tags with `v` prefixed e.g. `v1.0.0` or `v1.3.2`.

2. Postfix
	If you would like to append something to the end of created tag you can use `--postfix` option. For example, if you would want to append `-dev` to the tag, you can do the below

 ```shell
 $ git semver patch --postfix=-dev
 ```

This will result in something along the lines of `3.5.1-dev` depending upon the last tag

## A Real World Example of Semantic Versioning

Some useful examples of semantic versioning are given below:

```
v0.0.0 // New project
v0.1.0 // Add some functionality
v0.2.0 // Add other new functionality
v0.2.1 // Fix bug
v0.3.0 // Add some functionality
v0.3.1 // Fix bug
v0.3.2 // Fix bug
v0.3.3 // Fix bug
v0.3.4 // Fix bug
v0.4.0 // Add some functionality
v0.4.1 // Fix bug
v0.4.2 // Fix bug
v1.0.0 // Code is being used in production
v1.1.0 // Add some functionality
v1.2.0 // Add other new functionality
v1.2.1 // Fix bug
v2.0.0 // Implement changes that causes backwards incompatible
```

## Contribution

Feel free to fork, improve, create issues and spread the word.

## License

MIT &copy; [Zeeshan Ahmed](http://github.com/zeeshanu)
