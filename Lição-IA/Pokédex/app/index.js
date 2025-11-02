import { Link } from 'expo-router';
import { StatusBar, Text, TouchableOpacity, View } from 'react-native';

export default function Home() {
  return (
    <View style={{ 
      flex: 1, 
      justifyContent: 'center', 
      alignItems: 'center',
      backgroundColor: '#FF0000' 
    }}>
      <StatusBar barStyle="light-content" backgroundColor="#FF0000" />
      
      <View style={{ 
        backgroundColor: 'white', 
        padding: 30, 
        borderRadius: 20, 
        alignItems: 'center',
      }}>
        <Text style={{ 
          fontSize: 32, 
          fontWeight: 'bold', 
          color: '#FF0000', 
          marginBottom: 10 
        }}>
          Pokédex Kanto
        </Text>
        
        <Text style={{ 
          fontSize: 16, 
          color: '#333', 
          textAlign: 'center', 
          marginBottom: 30,
        }}>
          Explore os 151 Pokémon originais!
        </Text>

        <Link href="/pokemon-list" asChild>
          <TouchableOpacity style={{
            backgroundColor: '#FF0000',
            padding: 15,
            borderRadius: 8,
            alignItems: 'center',
            marginVertical: 8,
            width: 200
          }}>
            <Text style={{ color: 'white', fontSize: 16, fontWeight: 'bold' }}>
              Começar
            </Text>
          </TouchableOpacity>
        </Link>
      </View>
    </View>
  );
}