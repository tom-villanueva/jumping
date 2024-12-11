'use client'
import Navbar from './sections/Navbar.js'
import Footer from './sections/Footer.js'
import RentalScreen from './sections/RentalScreen.js'
import { SWRConfig } from 'swr'
import { fetcher } from '@/lib/utils'

export default function Example() {
  return (
    <div>
      <SWRConfig
        value={{
          fetcher: fetcher,
        }}>
        <Navbar />
        <RentalScreen />
        <Footer />
      </SWRConfig>
    </div>
  )
}
