import React, { Fragment, useState, useEffect } from "react"
import { Text, TouchableHighlight, View, SafeAreaView, TextInput, ScrollView, Dimensions, ImageBackground } from "react-native"
import Tailwind from "../libs/tailwind/Tailwind.lib"
import { ArrowLeftIcon } from "react-native-heroicons/solid"
import { EyeIcon, EyeOffIcon } from "react-native-heroicons/solid"
import ButtonPrimary from "../components/molecules/ButtonPrimary.molecule"

const DetailWorker = ({ navigation }) => {
    const [height, setHeight] = useState(0)
    const [isHide, setIsHide] = useState(true)

    useEffect(() => {
        setHeight(() => Dimensions.get("screen").height)

        Dimensions.addEventListener("change", () => {
            setHeight(() => Dimensions.get("screen").height)
        })
    }, [])

    return (
        <Fragment>
            <SafeAreaView>
                <View style={ [Tailwind`w-full flex flex-col bg-primary--red--20 px-6`, { height }] }>
                    <ScrollView>
                        <View style={ Tailwind`flex flex-row items-cente my-6` }>
                            <TouchableHighlight underlayColor={ "#10101010" } style={ Tailwind`rounded-full` } onPress={ () => navigation.goBack() }>
                                <ArrowLeftIcon size={ 22 } style={ Tailwind`text-accent--black opacity-50` }/>
                            </TouchableHighlight>
                            <Text style={ Tailwind`font-rubik-semibold text-primary--red ml-4 text-base` }>
                                Daftar Pegawai
                            </Text>
                        </View>
                        <View style={ Tailwind`w-full flex flex-col bg-white rounded-2xl` }>
                            <View style={ Tailwind`w-full px-6 py-6` }>
                                <View style={ Tailwind`w-full py-5 flex flex-row justify-center bg-primary--red--20 rounded-lg mb-5` }>
                                    <Text style={ Tailwind`font-rubik-semibold text-primary--red ml-4 text-base` }>
                                        Detail Pegawai
                                    </Text>
                                </View>
                                <View style={ Tailwind`w-full flex flex-row items-center` }>
                                    <ImageBackground
                                        source={ { uri: "https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8Mnx8YXZhdGFyfGVufDB8fDB8fA%3D%3D&auto=format&fit=crop&w=500&q=60" } }
                                        resizeMode={ "cover" }
                                        style={ Tailwind`w-46 h-50 rounded-xl overflow-hidden` }
                                    />
                                    <View style={ Tailwind`flex-grow flex flex-col ml-10` }>
                                        <TextInput
                                            placeholder="Nama Lengkap"
                                            style={ Tailwind`text-sm text-accent--black tracking-wide w-full px-5 py-4 rounded-md border border-gray-200` }
                                        />
                                        <TextInput
                                            placeholder="..."
                                            style={ Tailwind`text-sm text-accent--black tracking-wide w-full px-5 py-4 rounded-md border border-gray-200 mt-3` }
                                        />
                                    </View>
                                </View>
                                <View style={ Tailwind`w-full flex flex-row items-center mt-5` }>
                                    <Text style={ Tailwind`font-rubik-regular text-accent--black text-sm mr-5` }>
                                        Hak Akses
                                    </Text>
                                    <TextInput
                                        placeholder="..."
                                        style={ Tailwind`text-sm text-accent--black tracking-wide flex-grow px-5 py-4 rounded-md border border-gray-200 mt-3` }
                                    />
                                </View>
                                <TextInput
                                    placeholder="90284102323"
                                    style={ Tailwind`text-sm text-accent--black tracking-wide w-full px-5 py-4 rounded-md border border-gray-200 mt-3` }
                                    editable={ false }
                                />
                                <TextInput
                                    placeholder="example@gmail.com"
                                    style={ Tailwind`text-sm text-accent--black tracking-wide w-full px-5 py-4 rounded-md border border-gray-200 mt-3` }
                                    editable={ false }
                                />
                                <View style={ Tailwind`w-full px-5 py-4 rounded-md bg-transparent border border-gray-200 mt-3 flex flex-row items-center justify-between` }>
                                    <TextInput
                                        placeholder="Pin 6 Angka"
                                        value="asdasdasd"
                                        style={ Tailwind`text-sm text-accent--black tracking-wide p-0 flex-grow` }
                                        secureTextEntry={ isHide }
                                        editable={ false }
                                    />
                                    {
                                        isHide ? 
                                            <TouchableHighlight underlayColor={ "#10101010" } onPress={ () => setIsHide((value) => !value) }>
                                                <EyeIcon size={ 22 } style={ Tailwind`text-accent--black` }/>
                                            </TouchableHighlight> :
                                            <TouchableHighlight underlayColor={ "#10101010" } onPress={ () => setIsHide((value) => !value) }>
                                                <EyeOffIcon size={ 22 } style={ Tailwind`text-accent--black` }/>
                                            </TouchableHighlight>
                                    }
                                </View>
                                <View style={ Tailwind`w-80 self-end mt-10` }>
                                    <ButtonPrimary text={ "EDIT" }/>
                                </View>
                            </View>
                        </View>
                        <View style={ Tailwind`h-6` }/>
                    </ScrollView>
                </View>
            </SafeAreaView>
        </Fragment>
    )
}

export default DetailWorker