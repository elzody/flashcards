import path from 'path'
import vue from '@vitejs/plugin-vue'
import { defineConfig } from 'vite'
import { createAppConfig } from '@nextcloud/vite-config'

/*// https://vitejs.dev/config/
export default defineConfig({
  plugins: [vue()],
  build: {
  	outDir: 'js/',
  	assetsDir: '',
  	cssCodeSplit: false,
  	sourceMap: true,
  	emptyOutDir: true,
  	rollupOptions: {
  		input: {
  			main: path.resolve(__dirname, 'src', 'main.js'),
  		},
  	},
  },
})*/

const overrides = defineConfig({
	plugins: [vue()],
})

export default createAppConfig(
	{
		main: path.resolve(__dirname, 'src', 'main.ts'),
	} /*, {
	config: overrides,
}*/,
)
