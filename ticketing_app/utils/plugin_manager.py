import os
import importlib.util

PLUGINS_FOLDER = "plugins"

def load_plugins():
    for filename in os.listdir(PLUGINS_FOLDER):
        if filename.endswith(".py"):
            plugin_name = filename[:-3]
            plugin_path = os.path.join(PLUGINS_FOLDER, filename)
            spec = importlib.util.spec_from_file_location(plugin_name, plugin_path)
            module = importlib.util.module_from_spec(spec)
            spec.loader.exec_module(module)
            if hasattr(module, "main"):
                module.main()