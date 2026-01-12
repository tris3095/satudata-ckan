import './bootstrap';
import Swal from 'sweetalert2';
import { togglePassword } from './togglePassword';

window.Swal = Swal;
window.togglePassword = togglePassword;
