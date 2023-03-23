import React, { Fragment, useState, useEffect } from "react"
import { Text, TouchableHighlight, View, SafeAreaView, TextInput, ScrollView, Dimensions } from "react-native"
import Tailwind from "../libs/tailwind/Tailwind.lib"
import { ArrowLeftIcon, CameraIcon } from "react-native-heroicons/outline"
import { EyeIcon, EyeOffIcon } from "react-native-heroicons/solid"
import ButtonSecondary from "../components/molecules/ButtonSecondary.molecule"

const AddWorker = ({ navigation }) => {
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
                    <ScrollView showsVerticalScrollIndicator={ false }>
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
                                <View style={ Tailwind`w-full py-5 flex flex-row justify-center bg-gray-200 rounded-lg mb-5` }>
                                    <Text style={ Tailwind`font-rubik-semibold text-gray-500 ml-4 text-base` }>
                                        Detail Pegawai
                                    </Text>
                                </View>
                                <View style={ Tailwind`w-full flex flex-row items-center` }>
                                    <View style={ Tailwind`w-45 h-45 rounded-md border-2 border-gray-300 bg-gray-200 self-center flex flex-col items-center justify-center` }>
                                        <Text style={ Tailwind`text-accent--black text-3xl` }>
                                            NP
                                        </Text>
                                    </View>
                                    <View style={ [Tailwind`w-10 h-10 rounded-full bg-primary--red flex flex-col items-center justify-center shadow-lg self-center z-50`, { transform: [{ translateY: 80 }, { translateX: -20 }] }] }>
                                        <CameraIcon size={ 22 } style={ Tailwind`text-white` }/>
                                    </View>
                                    <View style={ Tailwind`flex-grow flex flex-col ml-5` }>
                                        <TextInput
                                            placeholder="Nama Pegawai"
                                            style={ Tailwind`text-sm text-accent--black tracking-wide w-full px-5 py-4 rounded-md border border-gray-200` }
                                        />
                                        <TextInput
                                            placeholder="Jabatan"
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
                                    placeholder="No.Handphone"
                                    style={ Tailwind`text-sm text-accent--black tracking-wide w-full px-5 py-4 rounded-md border border-gray-200 mt-3` }
                                />
                                <TextInput
                                    placeholder="Alamat Email"
                                    style={ Tailwind`text-sm text-accent--black tracking-wide w-full px-5 py-4 rounded-md border border-gray-200 mt-3` }
                                />
                                <View style={ Tailwind`w-full px-5 py-4 rounded-md bg-transparent border border-gray-200 mt-3 flex flex-row items-center justify-between` }>
                                    <TextInput
                                        placeholder="PIN"
                                        style={ Tailwind`text-sm text-accent--black tracking-wide p-0 flex-grow` }
                                        secureTextEntry={ isHide }
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
                            </View>
                        </View>
                        <View style={ Tailwind`w-full my-3` }>
                            <ButtonSecondary text={ "Outlet" }/>
                        </View>
                        <View style={ Tailwind`w-full p-6 flex flex-col items-center bg-white rounded-2xl` }>
                            <Text style={ Tailwind`font-rubik-regular text-xs opacity-50` }>
                                Tekan "Pilih Outlet" untuk memilih tempat pegawai bekerja
                            </Text>
                            <View style={ Tailwind`px-6 py-3 rounded-md border border-gray-300 bg-gray-100 mt-5` }>
                                <Text style={ Tailwind`font-rubik-regular text-xs text-accent--black` }>
                                    Pilih Outlet
                                </Text>
                            </View>
                        </View>
                        <View style={ Tailwind`w-full p-6 flex flex-col items-center bg-white rounded-2xl mt-3` }>
                            <ButtonSecondary text={ "Simpan" }/>
                        </View>
                        <View style={ Tailwind`h-6` }/>
                    </ScrollView>
                </View>
            </SafeAreaView>
        </Fragment>
    )
}

export default AddWorker