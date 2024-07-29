import { createAppConfig } from '@nextcloud/vite-config'
import path from 'path'

export default createAppConfig({
  main: path.resolve(__dirname, 'src', 'main.js'),
})