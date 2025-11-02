import { Stack } from "expo-router";

export default function RootLayout() {
  return (
    <Stack>
      <Stack.Screen name="index" options={{ headerShown: false }} />
      <Stack.Screen name="pokemon-list" options={{ title: "Pokémon" }} />
      <Stack.Screen name="pokemon-detail" options={{ title: "Detalhes" }} />
    </Stack>
  );
}