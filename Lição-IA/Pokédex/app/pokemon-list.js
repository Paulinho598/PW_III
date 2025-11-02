import { Link } from 'expo-router';
import { useEffect, useState } from 'react';
import { ActivityIndicator, FlatList, Image, Text, TouchableOpacity, View } from 'react-native';
import { getKantoPokemon } from './services/api';

export default function PokemonList() {
    const [pokemonList, setPokemonList] = useState([]);
    const [loading, setLoading] = useState(true);

    useEffect(() => {
        loadPokemon()
    }, [])

    const loadPokemon = async() => {
        try{
            const pokemon = await getKantoPokemon()
            setPokemonList(pokemon)
        }catch (error){
            console.error("ERRO:", error)
        }finally{
            setLoading(false)
        }
    }

    if(loading){
        return(
            <View style={{flex: 1, justifyContent: 'center', alignContent: 'center'}}>
                <ActivityIndicator size="large" color="#FF0000"/>
                <Text style={{marginTop: 10}}>Carregando Pokémon...</Text>
            </View>
        )
    }

    const renderPokemonItem = ({item, index}) => {
        const pokemonId = index + 1
        const imageUrl = `https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/${pokemonId}.png`

        return (
            <Link href={`/pokemon-detail?id=${pokemonId}`} asChild>
            <TouchableOpacity style={{
                flexDirection: 'row',
                alignItems: 'center',
                backgroundColor: 'white',
                padding: 15,
                marginVertical: 5,
                marginHorizontal: 10,
                borderRadius: 10,
                shadowColor: '#000',
                shadowOffset: { width: 0, height: 2 },
                shadowOpacity: 0.1,
                shadowRadius: 4,
                elevation: 3,
            }}>
                <Image
                source={{ uri: imageUrl }}
                style={{ width: 60, height: 60 }}
                />
                <View style={{ marginLeft: 15 }}>
                <Text style={{ fontSize: 16, fontWeight: 'bold' }}>
                    #{pokemonId.toString().padStart(3, '0')}
                </Text>
                <Text style={{ fontSize: 18, fontWeight: 'bold', color: '#333' }}>
                    {item.name.charAt(0).toUpperCase() + item.name.slice(1)}
                </Text>
                </View>
            </TouchableOpacity>
            </Link>
        );
    }
    return (
        <View style={{ flex: 1, backgroundColor: '#f5f5f5' }}>
        <Text style={{ 
            fontSize: 24, 
            fontWeight: 'bold', 
            margin: 16,
            textAlign: 'center',
            color: '#333'
        }}>
            Pokédex Kanto ({pokemonList.length})
        </Text>
        
        <FlatList
            data={pokemonList}
            keyExtractor={(item) => item.name}
            renderItem={renderPokemonItem}
            showsVerticalScrollIndicator={false}
        />
        </View>
    );
}