# Finally! A swift way of adding custom settings to any node in Kunstmaan Bundles CMS

## Installation

Just `composer require nassau/kunstmaan-node-settings-bundle` and add `\Nassau\KunstmaanNodeSettingsBundle\NodeSettingsBundle` to your AppKernel file.

## Usage

1. Create an Entity to hold your settings (it’s best if it has relation to a `NodeTranslation`, but it’s up to you) and a FormType for it
2. Create a SettingsHandler. To do this implement the `\Nassau\KunstmaanNodeSettingsBundle\Services\NodeSettingsHandlerInterface` interface and register that service in the container with a `nassau.node_settings` tag
3. Your form type will automatically show up when editing the node, and the entity will be persisted on save. Et voilà!

## Kitchen sink

The whole aim of this bundle is to be *simple*. So instead of creating everything from scratch, let’s use some existing boilerplate.

### `AbstractNodeSettingEntity`

Use this class as a base for your entity so you’d have a `nodeTranslation` association defined out of the box.
 
### `AbstractNodeSettingsHandler`

Extend this class to have a simpler handler. It will use defaults for most of the values and only require you to set:

 * The name of the entity class for your settings
 * The name of the form type class
 * And the name of the handler itself
 
The settings node will be automatically fetched and saved based on the current `NodeTranslation`.


## Examples

Ok, so you still don’t get it and need a TL;DR or an example? [Look at the examples](examples/)
