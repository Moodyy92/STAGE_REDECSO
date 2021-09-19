/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.scss in this case)
import './styles/app.scss';

// start the Stimulus application
import './bootstrap';


//////////////////// DATATABLE ////////////////////

var $  = require( 'jquery' );
require( 'datatables.net-bs5' )();
require( 'datatables.net-editor-bs5' )();
require( 'datatables.net-buttons-bs5' )();
require( 'datatables.net-buttons/js/buttons.html5.js' )();
require( 'datatables.net-datetime' )();
// require( 'datatables.net-responsive-bs5' )();
require( 'datatables.net-select-bs5' )();
require('bootstrap');