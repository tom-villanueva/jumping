import React from 'react'
import {
  Dialog,
  DialogContent,
  DialogDescription,
  DialogHeader,
  DialogTitle,
  DialogTrigger,
} from '@/components/ui/dialog'
import {
  Select,
  SelectContent,
  SelectItem,
  SelectTrigger,
  SelectValue,
} from '@/components/ui/select'
import { Input } from '@/components/ui/input'
import { useState } from 'react'

export default function ProductBox({ title }) {
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

  const [altura, setAltura] = useState('')
  const [peso, setPeso] = useState('')
  const [talle, setTalle] = useState('')
  const [nivel, setNivel] = useState('')
  const [cantidad, setCantidad] = useState(1)

  function handleSelect(altura, peso, talle, nivel, cantidad) {
    if (!cantidad || cantidad < 1) {
      alert('cantidad erronea')
    }

    const newProduct = {
      altura: altura,
      peso: peso,
      talle: talle,
      nivel: nivel,
      cantidad: cantidad,
    }

    carrito.push(newProduct)
    console.log(carrito)
  }

  function handleCounter(value) {
    console.log(cantidad)

    if (value === 'minus') {
      if (cantidad == 1) {
        setCantidad(1)
        return
      }
      setCantidad(cantidad - 1)
      return
    }
    if (value === 'plus') {
      setCantidad(cantidad + 1)
      return
    }

    if (!cantidad) {
      console.log('llegue')

      setCantidad(1)
    }
    setCantidad(value)
    console.log(cantidad)
  }

  const carrito = []

  return (
    <div className="flex w-11/12 items-center justify-center sm:w-full">
      <div className="mx-auto max-w-2xl px-4 py-5 sm:max-w-7xl sm:px-6 sm:py-5 lg:px-8">
        <h2 className="text-center font-montserrat text-2xl font-bold uppercase tracking-tight text-gray-900">
          {title}
        </h2>

        <div className="mt-6 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
          {products.map(product => (
            <div key={product.id} className="relative">
              <div className="aspect-h-1 aspect-w-1 lg:aspect-none w-full overflow-hidden rounded-md bg-gray-200 lg:h-80">
                <img
                  alt={product.imageAlt}
                  src={product.imageSrc}
                  className="h-full w-full object-cover object-center lg:h-full lg:w-full"
                />
              </div>
              <div className="mt-4 flex">
                <div>
                  <h3 className="line-clamp-1 font-archivo font-medium text-black">
                    {product.name}
                  </h3>

                  <Dialog>
                    <DialogTrigger className="mt-1 text-sm text-gray-500 transition-all duration-75 ease-in hover:text-gray-700">
                      Ver más
                    </DialogTrigger>
                    <DialogContent>
                      <DialogHeader>
                        <DialogTitle>Are you absolutely sure?</DialogTitle>
                        <DialogDescription>
                          This action cannot be undone. This will permanently
                          delete your account and remove your data from our
                          servers.
                        </DialogDescription>
                      </DialogHeader>
                    </DialogContent>
                  </Dialog>
                </div>
              </div>
              <div className="my-4 flex justify-between font-medium">
                <p className="font-montserrat text-black">Valor por día</p>
                <p className="text-sm font-medium text-red-600">
                  {product.price}
                </p>
              </div>
              <Dialog>
                <DialogTrigger className="flex w-full items-center justify-center rounded-sm border-[1px] border-red-600 py-1 font-archivo font-medium text-black transition-all duration-75 ease-in hover:bg-red-600 hover:text-white">
                  Seleccionar
                </DialogTrigger>
                <DialogContent className="max-w-3xl bg-zinc-900">
                  <DialogHeader>
                    <div className="grid grid-cols-5 gap-10">
                      <div className="col-span-2 flex flex-col border-r border-white pr-10">
                        <DialogTitle className="mb-5 font-montserrat text-sm font-light">
                          Equipo Completo
                        </DialogTitle>
                        <img
                          alt={product.imageAlt}
                          src={product.imageSrc}
                          className="h-full w-full object-cover object-center lg:h-full lg:w-full"
                        />
                        <DialogTitle className="my-5 font-archivo">
                          {product.name}
                        </DialogTitle>
                        <DialogDescription className="font-montserrat font-light text-white">
                          This action cannot be undone. This will permanently
                          delete your account and remove your data from our
                          servers.dfisdfhns gfdignfdignifgn fdgidfngidfgnidfgn
                          dfgindfgi
                        </DialogDescription>
                      </div>
                      <div className="col-span-3 flex w-full flex-col items-center justify-center">
                        <div className="grid w-full grid-cols-2 gap-8">
                          <div className="w-full">
                            <label className="mb-2 flex items-center justify-center font-archivo">
                              ALTURA
                            </label>
                            <Select onValueChange={setAltura}>
                              <SelectTrigger className="w-full bg-zinc-900">
                                <SelectValue placeholder="Theme" />
                              </SelectTrigger>
                              <SelectContent>
                                <SelectItem value="light">Light</SelectItem>
                                <SelectItem value="dark">Dark</SelectItem>
                                <SelectItem value="system">System</SelectItem>
                              </SelectContent>
                            </Select>
                          </div>
                          <div>
                            <label className="mb-2 flex items-center justify-center font-archivo">
                              PESO
                            </label>
                            <Select onValueChange={setPeso}>
                              <SelectTrigger className="w-full bg-zinc-900">
                                <SelectValue placeholder="Theme" />
                              </SelectTrigger>
                              <SelectContent>
                                <SelectItem value="light">Light</SelectItem>
                                <SelectItem value="dark">Dark</SelectItem>
                                <SelectItem value="system">System</SelectItem>
                              </SelectContent>
                            </Select>
                          </div>
                          <div>
                            <label className="mb-2 flex items-center justify-center font-archivo">
                              TALLE
                            </label>
                            <Select onValueChange={setTalle}>
                              <SelectTrigger className="w-full bg-zinc-900">
                                <SelectValue placeholder="Theme" />
                              </SelectTrigger>
                              <SelectContent>
                                <SelectItem value="light">Light</SelectItem>
                                <SelectItem value="dark">Dark</SelectItem>
                                <SelectItem value="system">System</SelectItem>
                              </SelectContent>
                            </Select>
                          </div>
                          <div>
                            <label className="mb-2 flex items-center justify-center font-archivo">
                              NIVEL
                            </label>
                            <Select onValueChange={setNivel}>
                              <SelectTrigger className="w-full bg-zinc-900">
                                <SelectValue placeholder="Theme" />
                              </SelectTrigger>
                              <SelectContent>
                                <SelectItem value="light">Light</SelectItem>
                                <SelectItem value="dark">Dark</SelectItem>
                                <SelectItem value="system">System</SelectItem>
                              </SelectContent>
                            </Select>
                          </div>
                          <div className="col-span-2 flex w-full flex-row items-center justify-center">
                            <button
                              className="rounded-l-lg bg-red-600 p-2 font-archivo font-bold"
                              onClick={() => handleCounter('minus')}>
                              -
                            </button>
                            <Input
                              type="number"
                              placeholder={cantidad}
                              value={cantidad}
                              className="max-w-[100px] rounded-sm bg-zinc-900 text-white"
                              onChange={e => handleCounter(e.target.value)}
                            />

                            <button
                              className="rounded-r-lg bg-red-600 p-2 font-archivo font-bold"
                              onClick={() => handleCounter('plus')}>
                              +
                            </button>
                          </div>
                          <div className="col-span-2 flex flex-col items-center justify-center gap-6">
                            <p className="font-montserrat font-bold tracking-widest">
                              Valor por dia:{' '}
                              <span className="font-montserrat font-bold text-red-600">
                                {product.price}
                              </span>
                            </p>
                            <button
                              className="rounded-full bg-red-600 px-5 py-3 font-montserrat font-bold transition-all duration-75 ease-in hover:bg-red-800"
                              onClick={() =>
                                handleSelect(
                                  altura,
                                  peso,
                                  talle,
                                  nivel,
                                  cantidad,
                                )
                              }>
                              SELECCIONAR
                            </button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </DialogHeader>
                </DialogContent>
              </Dialog>
            </div>
          ))}
        </div>
      </div>
    </div>
  )
}
