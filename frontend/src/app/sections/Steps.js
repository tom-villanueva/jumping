import React from 'react'

export default function Steps({ bgStyle }) {
  return (
    <div className="flex w-3/4 flex-row items-center justify-evenly overflow-auto">
      <div className="flex flex-col items-center justify-center">
        <p
          className={
            bgStyle === 1
              ? 'max-w-[25px] rounded-full bg-red-600 px-2 text-white'
              : 'max-w-[25px] rounded-full bg-black px-2 text-white'
          }>
          1
        </p>
        <p
          className={
            bgStyle === 1
              ? 'w-[160px] text-center text-white'
              : 'w-[160px] text-center text-black'
          }>
          Selecciona la fecha
        </p>
      </div>
      <hr
        className={
          bgStyle === 1 ? 'border-1 w-full' : 'border-1 w-full border-black'
        }></hr>
      <div className="flex flex-col items-center justify-center">
        <p
          className={
            bgStyle === 1
              ? 'max-w-[25px] rounded-full bg-white px-2 text-black'
              : 'max-w-[25px] rounded-full bg-red-600 px-2 text-white'
          }>
          2
        </p>
        <p
          className={
            bgStyle === 1
              ? 'w-[160px] text-center text-white'
              : 'w-[160px] text-center text-black'
          }>
          Elige tu equipo
        </p>
      </div>
      <hr
        className={
          bgStyle === 1 ? 'border-1 w-full' : 'border-1 w-full border-black'
        }></hr>
      <div className="flex flex-col items-center justify-center">
        <p
          className={
            bgStyle === 1
              ? 'max-w-[25px] rounded-full bg-white px-2 text-black'
              : 'max-w-[25px] rounded-full bg-black px-2 text-white'
          }>
          3
        </p>
        <p
          className={
            bgStyle === 1
              ? 'w-[160px] text-center text-white'
              : 'w-[160px] text-center text-black'
          }>
          Carga tus datos
        </p>
      </div>
      <hr
        className={
          bgStyle === 1 ? 'border-1 w-full' : 'border-1 w-full border-black'
        }></hr>
      <div className="flex flex-col items-center justify-center">
        <p
          className={
            bgStyle === 1
              ? 'max-w-[25px] rounded-full bg-white px-2 text-black'
              : 'max-w-[25px] rounded-full bg-black px-2 text-white'
          }>
          4
        </p>
        <p
          className={
            bgStyle === 1
              ? 'w-[160px] text-center text-white'
              : 'w-[160px] text-center text-black'
          }>
          Paga y disfruta
        </p>
      </div>
    </div>
  )
}
