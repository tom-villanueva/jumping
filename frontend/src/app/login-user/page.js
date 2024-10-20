'use client'
import React from 'react'
import Navbar from '../sections/Navbar.js'
import Footer from '../sections/Footer.js'
import LoginForm from '../sections/login-form/LoginForm.js'
export default function page() {
  return (
    <div>
      <Navbar />
      <LoginForm />
      <Footer />
    </div>
  )
}
