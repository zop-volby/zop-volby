import './bootstrap';

import Alpine from 'alpinejs';
import { Main } from '../../client/main.ts'

window["Alpine"] = Alpine;

Alpine.start();

Main();


