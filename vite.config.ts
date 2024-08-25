import path from 'path'
import { createAppConfig } from '@nextcloud/vite-config'

export default createAppConfig({
	main: path.resolve(__dirname, 'src', 'main.ts'),
})
