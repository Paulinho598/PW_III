import { useLocalSearchParams } from 'expo-router';
import { useEffect, useState } from 'react';
import { ActivityIndicator, Image, ScrollView, Text, View } from 'react-native';
import { getPokemonDetails } from './services/api';

export default function PokemonDetail() {
  const { id } = useLocalSearchParams();
  const [pokemon, setPokemon] = useState(null);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    if (id) {
      loadPokemonDetails();
    }
  }, [id]);

  const loadPokemonDetails = async () => {
    try {
      const details = await getPokemonDetails(id);
      setPokemon(details);
    } catch (error) {
      console.error('Erro:', error);
    } finally {
      setLoading(false);
    }
  };

  if (loading) {
    return (
      <View style={{ flex: 1, justifyContent: 'center', alignItems: 'center' }}>
        <ActivityIndicator size="large" color="#FF0000" />
        <Text style={{ marginTop: 10 }}>Carregando...</Text>
      </View>
    );
  }

  if (!pokemon) {
    return (
      <View style={{ flex: 1, justifyContent: 'center', alignItems: 'center' }}>
        <Text>Pokémon não encontrado</Text>
      </View>
    );
  }

  const imageUrl = `https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/${pokemon.id}.png`;

  return (
    <ScrollView style={{ flex: 1, backgroundColor: '#f5f5f5' }}>
      <View style={{ alignItems: 'center', padding: 20 }}>
        <Text style={{ fontSize: 16, color: '#666' }}>
          #{pokemon.id.toString().padStart(3, '0')}
        </Text>
        <Text style={{ fontSize: 28, fontWeight: 'bold', marginBottom: 10 }}>
          {pokemon.name.charAt(0).toUpperCase() + pokemon.name.slice(1)}
        </Text>
        
        <Image
          source={{ uri: imageUrl }}
          style={{ width: 200, height: 200 }}
        />

        {/* Tipos */}
        <View style={{ flexDirection: 'row', marginVertical: 10 }}>
          {pokemon.types.map((typeInfo, index) => (
            <View key={index} style={{
              backgroundColor: '#FF0000',
              paddingHorizontal: 15,
              paddingVertical: 5,
              borderRadius: 15,
              marginHorizontal: 5,
            }}>
              <Text style={{ color: 'white', fontWeight: 'bold' }}>
                {typeInfo.type.name.toUpperCase()}
              </Text>
            </View>
          ))}
        </View>
      </View>

      {/* Estatísticas */}
      <View style={{ backgroundColor: 'white', margin: 10, padding: 15, borderRadius: 10 }}>
        <Text style={{ fontSize: 20, fontWeight: 'bold', marginBottom: 10 }}>Estatísticas</Text>
        {pokemon.stats.map((stat, index) => (
          <View key={index} style={{ flexDirection: 'row', justifyContent: 'space-between', marginBottom: 8 }}>
            <Text style={{ fontWeight: 'bold' }}>
              {stat.stat.name.replace('-', ' ').toUpperCase()}:
            </Text>
            <Text>{stat.base_stat}</Text>
          </View>
        ))}
      </View>

      {/* Habilidades */}
      <View style={{ backgroundColor: 'white', margin: 10, padding: 15, borderRadius: 10 }}>
        <Text style={{ fontSize: 20, fontWeight: 'bold', marginBottom: 10 }}>Habilidades</Text>
        {pokemon.abilities.map((ability, index) => (
          <Text key={index} style={{ marginBottom: 5 }}>
            • {ability.ability.name.charAt(0).toUpperCase() + ability.ability.name.slice(1)}
          </Text>
        ))}
      </View>
    </ScrollView>
  );
}