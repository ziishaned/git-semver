

 # git-semver

[![Build Status](https://travis-ci.org/zeeshanu/git-semver.svg?branch=master)](https://travis-ci.org/zeeshanu/git-semver)
[![Latest Version](https://img.shields.io/github/release/zeeshanu/git-profile.svg?style=flat-square)](https://github.com/zeeshanu/git-profile/releases)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)

> A CLI tool to generate [semantic versioning](semver.org) compliant tags for your git repositories. 

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

### Patch Command

Create a patch release i.e. increment the last part of the tag by 1 e.g. it will generate `x.y.0` to `x.y.1`.

```shell
$ git semver patch
```

### Minor Command

This command is use to create minor release. You can also provide `--fetch` option. The below command first fethes all the latest tags and then create a minor release. 

```shell
$ git semver minor --fetch
```

Above command will generate `x.0.z` to `x.1.z` depending upon the previous tag.

### Major Command

This command will generate a major release e.g.  `0.y.z` to `1.1.z` depending upon the previous tag.

```shell
$ git semver major --postfix='-dev'
```

### Prefix and Postfix Usage

1. Prefix

If you want to create a major release while prefixing `v` then you only need to provide --prefix option. The usage of prefixing is given  below:

```shell
$ git semver patch --prefix=v
```

The above command will generate `v1.0.0` or `v1.3.2` depending upon the previous tag.

2. Postfix
Create a patch release while postfixing `-dev` then below command will generate following result `1.0.0-dev` or `1.3.2-dev` depending upon the previous tag.

## A real world Example of Semantic Versioning
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