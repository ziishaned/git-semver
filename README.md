# git-semver

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

> Create a patch release i.e. will increment the last part of the tag by 1
> e.g. it will generate `0.0.1` or `1.3.1` depending upon the previous tag

```shell
$ git semver patch
```

> Create a patch release while prefixing `v`
> e.g. it will generate `v0.0.1` or `v1.3.2`

```shell
$ git semver patch --prefix=v
```

> Fetch before adding the tag (recommended)
> It will fetch the remote tags before creating the new tag

```shell
$ git semver minor --fetch
```

> Create a major release with a postfix
> Below command will generate the tags similar to `3.0.0-dev` 

```shell
$ git semver major --postfix='-dev'
```

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