import React from 'react'
import Steps from './Steps.js'
import RentForm from './RentForm.js'
import { useState } from 'react'

export default function RentalScreen() {
  const [bgStyle, setBgStyle] = useState(1)
  return (
    <div
      className={
        bgStyle === 1
          ? 'flex flex-col items-center justify-center bg-hero-image bg-cover bg-center py-6 grayscale-[40%]'
          : 'flex flex-col items-center justify-center border-white bg-gray-300'
      }>
      <div
        className={
          bgStyle === 1
            ? 'flex w-[90%] flex-col items-center rounded-sm bg-black/60 pb-16 sm:w-4/6'
            : 'flex w-[90%] flex-col items-center pb-16 sm:w-4/6'
        }>
        <h1
          className={
            bgStyle === 1
              ? 'my-16 text-center font-archivo text-4xl font-bold text-white sm:text-6xl'
              : 'my-16 text-center font-archivo text-4xl font-bold text-black sm:text-6xl'
          }>
          Temporada{' '}
          <span className="text-4xl font-bold text-red-600 sm:text-6xl">
            2024
          </span>
        </h1>
        <Steps bgStyle={bgStyle} />
        <RentForm setBgStyle={setBgStyle} />
      </div>
    </div>
  )
}
