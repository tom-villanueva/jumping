import React from 'react'
import Steps from './Steps.js'
import DateSelector from './step1/DateSelector.js'

export default function RentalScreen() {
  return (
    <div className="flex h-screen flex-col items-center justify-center bg-hero-image bg-cover bg-center grayscale-[40%]">
      <div className="flex w-5/6 flex-col items-center rounded-sm bg-black/60 sm:w-4/6">
        <h1 className="my-16 text-center text-6xl font-bold text-white">
          Temporada{' '}
          <span className="text-6xl font-bold text-red-600">2024</span>
        </h1>
        <Steps />
        <DateSelector />
      </div>
    </div>
  )
}
