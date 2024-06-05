import React from 'react'

export default function Steps() {
  return (
    <div className="flex w-3/4 flex-row items-center justify-evenly">
      <div className="flex flex-col items-center justify-center">
        <p className="max-w-[25px] rounded-full bg-red-600 px-2 text-white">
          1
        </p>
        <p className="w-[160px] text-center text-white">Selecciona la fecha</p>
      </div>
      <hr className="border-1 w-full"></hr>
      <div className="flex flex-col items-center justify-center">
        <p className="max-w-[25px] rounded-full bg-white px-2 text-black">2</p>
        <p className="w-[160px] text-center text-white">Elige tu equipo</p>
      </div>
      <hr className="border-1 w-full"></hr>
      <div className="flex flex-col items-center justify-center">
        <p className="max-w-[25px] rounded-full bg-white px-2 text-black">3</p>
        <p className="w-[160px] text-center text-white">Carga tus datos</p>
      </div>
      <hr className="border-1 w-full"></hr>
      <div className="flex flex-col items-center justify-center">
        <p className="max-w-[25px] rounded-full bg-white px-2 text-black">4</p>
        <p className="w-[160px] text-center text-white">Paga y disfruta</p>
      </div>
    </div>
  )
}
