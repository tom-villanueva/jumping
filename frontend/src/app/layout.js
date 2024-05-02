import '@/app/global.css'
import { Archivo_Black, Montserrat } from 'next/font/google'
import { Toaster } from '@/components/ui/toaster'

const archivo_black = Archivo_Black({
  subsets: ['latin'],
  weight: '400',
  display: 'swap',
  variable: '--font-archivo',
})

const montserrat = Montserrat({
  subsets: ['latin'],
  display: 'swap',
  variable: '--font-montserrat',
})

export const metadata = {
  title: 'Jumping',
}
const RootLayout = ({ children }) => {
  return (
    <html
      lang="en"
      className={`${archivo_black.variable} ${montserrat.variable}`}>
      <head />
      <body className="antialiased">
        {children}
        <Toaster />
      </body>
    </html>
  )
}

export default RootLayout
