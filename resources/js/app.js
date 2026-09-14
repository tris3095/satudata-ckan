import './bootstrap';
import Swal from 'sweetalert2';
import Swiper from 'swiper/bundle';
import 'swiper/css/bundle';
import { togglePassword } from './togglePassword';

window.Swal = Swal;
window.Swiper = Swiper;
window.togglePassword = togglePassword;
