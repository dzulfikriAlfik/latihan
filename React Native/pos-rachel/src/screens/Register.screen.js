import React, { Fragment, useState, useEffect } from "react"
import { SafeAreaView, View, Text, TextInput, ScrollView, Pressable, Dimensions } from "react-native"
import ButtonSecondary from "../components/molecules/ButtonSecondary.molecule"
import TopBar from "../components/organisms/TopBar.organism"
import Tailwind from "../libs/tailwind/Tailwind.lib"
import { EyeIcon, EyeOffIcon } from "react-native-heroicons/solid"

const Register = ({ navigation }) => {
    const [isHide, setIsHide] = useState(true)
    const [widthScreen, setWidthScreen] = useState(0)

    const handleResponsive = (actions) => {
        if (widthScreen > 0 && widthScreen <= 1000) {
            return actions[0]
        } else if(widthScreen > 1000) {
            return actions[1]
        } else {
            return actions[0]
        }
    }

    useEffect(() => {
        setWidthScreen(() => Dimensions.get("screen").width)

        Dimensions.addEventListener("change", () => {
            setWidthScreen(() => Dimensions.get("screen").width)
        })
    }, [])

    return (
        <Fragment>
            <ScrollView>
                <SafeAreaView style={ Tailwind`bg-gray-100` }>
                    <View style={ Tailwind`w-full flex flex-col bg-white` }>
                        <TopBar navigation={ navigation } text={ "Daftar" }/>
                        <View style={ Tailwind`w-full ${ handleResponsive(["px-6", "px-28"]) } py-6` }>
                            <Text style={ Tailwind`text-xs text-accent--black tracking-wide opacity-80` }>
                                Halo Usahawan, lengkapi data dibawah ini.
                            </Text>
                            <Text style={ Tailwind`font-bold text-accent--black text-base mt-2` }>
                                Data Usaha
                            </Text>
                            <TextInput
                                placeholder="Nama Usaha"
                                style={ Tailwind`text-sm text-accent--black tracking-wide w-full px-5 py-4 rounded-md bg-transparent border border-gray-200 mt-7` }
                            />
                            <TextInput
                                placeholder="Pilih Tipe Bisnis"
                                style={ Tailwind`text-sm text-accent--black tracking-wide w-full px-5 py-4 rounded-md bg-transparent border border-gray-200 mt-3` }
                            />
                            <TextInput
                                placeholder="Kelurahan Outlet Utama"
                                style={ Tailwind`text-sm text-accent--black tracking-wide w-full px-5 py-4 rounded-md bg-transparent border border-gray-200 mt-3` }
                            />
                        </View>
                    </View>
                    <View style={ Tailwind`w-full ${ handleResponsive(["px-6", "px-28"]) } py-6 mt-3 bg-white` }>
                        <Text style={ Tailwind`font-bold text-accent--black text-base mt-2` }>
                            Data Diri Pemilik Usaha
                        </Text>
                        <TextInput
                            placeholder="Nama Pemilik"
                            style={ Tailwind`text-sm text-accent--black tracking-wide w-full px-5 py-4 rounded-md bg-transparent border border-gray-200 mt-7` }
                        />
                        <TextInput
                            placeholder="No Handphone"
                            style={ Tailwind`text-sm text-accent--black tracking-wide w-full px-5 py-4 rounded-md bg-transparent border border-gray-200 mt-3` }
                        />
                        <View style={ Tailwind`w-full px-5 py-4 rounded-md bg-transparent border border-gray-200 mt-3 flex flex-row items-center justify-between` }>
                            <TextInput
                                placeholder="Pin 6 Angka"
                                style={ Tailwind`text-sm text-accent--black tracking-wide p-0 flex-grow` }
                                secureTextEntry={ isHide }
                            />
                            {
                                isHide ? 
                                    <Pressable onPress={ () => setIsHide((value) => !value) }>
                                        <EyeIcon size={ 22 } style={ Tailwind`text-accent--black` }/>
                                    </Pressable> :
                                    <Pressable onPress={ () => setIsHide((value) => !value) }>
                                        <EyeOffIcon size={ 22 } style={ Tailwind`text-accent--black` }/>
                                    </Pressable>
                            }
                        </View>
                        <TextInput
                            placeholder="Email"
                            style={ Tailwind`text-sm text-accent--black tracking-wide w-full px-5 py-4 rounded-md bg-transparent border border-gray-200 mt-3` }
                        />
                        <Pressable style={ Tailwind`w-full mt-10` }>
                            <ButtonSecondary text={ "Daftar" }/>
                        </Pressable>
                    </View>
                </SafeAreaView>
            </ScrollView>
        </Fragment>
    )
}

export default Register