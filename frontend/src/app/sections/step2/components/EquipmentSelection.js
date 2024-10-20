import React from 'react'
import ProductBox from './ProductBox.js'
import Order from './Order.js'
import Filters from './Filters.js'
import { useState } from 'react'

export default function EquipmentSelection({ range, setSteps, setBgStyle }) {
  const products = [
    {
      id: 1,
      name: 'Earthen Bottle',
      href: '#',
      price: '$48',
      imageSrc:
        'https://tailwindui.com/img/ecommerce-images/category-page-04-image-card-01.jpg',
      imageAlt:
        'Tall slender porcelain bottle with natural clay textured body and cork stopper.',
    },
    {
      id: 2,
      name: 'Nomad Tumbler',
      href: '#',
      price: '$35',
      imageSrc:
        'https://tailwindui.com/img/ecommerce-images/category-page-04-image-card-02.jpg',
      imageAlt:
        'Olive drab green insulated bottle with flared screw lid and flat top.',
    },
    {
      id: 3,
      name: 'Focus Paper Refill',
      href: '#',
      price: '$89',
      imageSrc:
        'https://tailwindui.com/img/ecommerce-images/category-page-04-image-card-03.jpg',
      imageAlt:
        'Person using a pen to cross a task off a productivity paper card.',
    },
    {
      id: 4,
      name: 'Machined Mechanical Pencil',
      href: '#',
      price: '$35',
      imageSrc:
        'https://tailwindui.com/img/ecommerce-images/category-page-04-image-card-04.jpg',
      imageAlt:
        'Hand holding black machined steel mechanical pencil with brass tip and top.',
    },
    {
      id: 5,
      name: 'Machined Mechanical Pencil',
      href: '#',
      price: '$35',
      imageSrc:
        'https://tailwindui.com/img/ecommerce-images/category-page-04-image-card-04.jpg',
      imageAlt:
        'Hand holding black machined steel mechanical pencil with brass tip and top.',
    },
    {
      id: 6,
      name: 'Machined Mechanical Pencil',
      href: '#',
      price: '$35',
      imageSrc:
        'https://tailwindui.com/img/ecommerce-images/category-page-04-image-card-04.jpg',
      imageAlt:
        'Hand holding black machined steel mechanical pencil with brass tip and top.',
    },
  ]

  const [esquiFilter, handleEsquiFilter] = useState(true)
  const [snowboardFilter, handleSnowboardFilter] = useState(true)
  const [equiposFilter, handleEquiposFilter] = useState(true)
  const [accesoriosFilter, handleAccesoriosFilter] = useState(true)

  function handleFilter(filter) {
    console.log(filter)

    if (filter == 'esqui') {
      handleEsquiFilter(!esquiFilter)
    } else if (filter == 'snowboard') {
      handleSnowboardFilter(!snowboardFilter)
    } else if (filter == 'equipos') {
      handleEquiposFilter(!equiposFilter)
    } else if (filter == 'accesorios') {
      handleAccesoriosFilter(!accesoriosFilter)
    }
  }

  return (
    <div className="flex flex-col items-center justify-center">
      <p className="mt-5 text-center font-montserrat uppercase text-black">
        {range.from.toDateString()} - {range.to.toDateString()}
      </p>
      <div className="flex w-full flex-col items-center justify-center">
        <Filters
          handleFilter={handleFilter}
          esquiFilter={esquiFilter}
          snowboardFilter={snowboardFilter}
          equiposFilter={equiposFilter}
          accesoriosFilter={accesoriosFilter}
        />
      </div>
      <div className="flex flex-col items-center justify-center">
        <div
          className={`overflow-hidden transition-all duration-700 ease-in-out ${
            esquiFilter
              ? 'my-3 my-3 flex max-h-full w-full items-center justify-center opacity-100'
              : 'max-h-0 opacity-0'
          }`}>
          <ProductBox title={'Esqui'} />
        </div>
        <div
          className={`overflow-hidden transition-all duration-700 ease-in-out ${
            snowboardFilter
              ? 'my-3 flex max-h-full w-full items-center justify-center opacity-100'
              : 'max-h-0 opacity-0'
          }`}>
          <ProductBox title={'Snowboard'} />
        </div>
        <div
          className={`overflow-hidden transition-all duration-700 ease-in-out ${
            equiposFilter
              ? 'my-3 flex max-h-full w-full items-center justify-center opacity-100'
              : 'max-h-0 opacity-0'
          }`}>
          <ProductBox title={'Equipos'} />
        </div>
        <div
          className={`overflow-hidden transition-all duration-700 ease-in-out ${
            accesoriosFilter
              ? 'my-3 flex max-h-full w-full items-center justify-center opacity-100'
              : 'max-h-0 opacity-0'
          }`}>
          <ProductBox title={'Accesorios'} />
        </div>
      </div>
      <div className="flex w-full flex-col items-center justify-center">
        <Order setSteps={setSteps} setBgStyle={setBgStyle} />
      </div>
    </div>
  )
}
