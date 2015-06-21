

function Base() {

  var SCRIPT_PATH = '/resources/scripts/';

  var CONFIG = {
    'form': 'helpers/formHelper'
  };

  function init_() {
    console.log('Base loaded ... ');
    console.log('Loading libs ... ');

    _loadLibs();
  }

  function _loadLibs() {
    var script = document.createElement('SCRIPT');
    var parent = document.getElementsByTagName('SCRIPT')[0];
    for (var i in CONFIG) {
      script.src = SCRIPT_PATH + CONFIG[i] + '.js';
      parent.parentNode.insertBefore(script, parent);
    }
  }

  var self = this;

  init_();
}

window['Base'] = Base;