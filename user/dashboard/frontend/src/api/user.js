import { resetUser } from 'redux/slices/userSlice'
import { setUser } from 'redux/slices/userSlice'

export const login = (body) => (dispatch) => {
  fetch(
    process.env.REACT_APP_BASE_URL + '/user/dashboard/backend/api.php?q=login',
    {
      method: 'POST',
      body: JSON.stringify(body),
    }
  )
    .then((res) => res.json())
    .then((res) => {
      if (res.message === 'Login successful') {
        localStorage.setItem('user', JSON.stringify(res.user))
        dispatch(setUser(res.user))
      } else {
        alert(res.error || 'Login Failed')
        localStorage.removeItem('user')
        dispatch(resetUser())
      }
    })
    .catch((err) => console.log(err.message))
}

export const signup = (body) => (dispatch) => {
  fetch(
    process.env.REACT_APP_BASE_URL +
      '/user/dashboard/backend/api.php?q=register',
    {
      method: 'POST',
      body: JSON.stringify(body),
    }
  )
    .then((response) => response.json())
    .then((res) => {
      if (res.error) {
        return alert(res.error)
      }
      if (res.message === 'Signup successful') {
        localStorage.setItem('user', JSON.stringify(res.user))
        dispatch(setUser(res.user))
      } else {
        alert('Registration Failed')
        localStorage.removeItem('user')
        dispatch(resetUser())
      }
    })
    .catch((error) => console.log(error.message))
}

export const updateProfile = (body) => (dispatch) => {
  fetch(
    process.env.REACT_APP_BASE_URL + '/user/dashboard/backend/api.php?q=update',
    {
      method: 'POST',
      body: JSON.stringify(body),
    }
  )
    .then((res) => res.json())
    .then((res) => {
      if (res.message === 'Update successful') {
        localStorage.setItem('user', JSON.stringify(res.user))
        dispatch(setUser(res.user))
      } else alert(res.error || 'Update Failed!!')
    })
    .catch((err) => console.log(err))
}

export const logout = () => (dispatch) => {
  localStorage.removeItem('user')
  dispatch(resetUser())
}