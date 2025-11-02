import axios from 'axios'
const API_BASE_URL = 'https://pokeapi.co/api/v2'

export const api = axios.create({
    baseURL: API_BASE_URL
})

//BUSCAR LISTA DE POKÉMON DE KANTO (1-151)
export const getKantoPokemon = async() =>{
    try{
        const response = await api.get(`/pokemon?limit=151`)
        return response.data.results
    }catch (error){
       console.error("ERRO AO BUSCAR POKÉMON:", error)
       return [] 
    }
}


//BUSCAR DETALHES DE UM POKÉMON ESPECÍFICO
export const getPokemonDetails = async(pokemonIdOrName) =>{
    try{
        const response = await api.get(`/pokemon/${pokemonIdOrName}`)
        return response.data
    }catch (error){
       console.error("ERRO AO BUSCAR DETALHES DO POKÉMON:", error)
       return [] 
    }
}