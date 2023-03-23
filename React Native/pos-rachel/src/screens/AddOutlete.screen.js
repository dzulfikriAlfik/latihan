import React, { Fragment, useState, useEffect } from "react"
import { Text, TouchableHighlight, View, SafeAreaView, TextInput, ScrollView, Dimensions, Image } from "react-native"
import Tailwind from "../libs/tailwind/Tailwind.lib"
import { ArrowLeftIcon, ChevronRightIcon } from "react-native-heroicons/solid"
import { CameraIcon, LocationMarkerIcon } from "react-native-heroicons/outline"
import ButtonPrimary from "../components/molecules/ButtonPrimary.molecule"

const AddOutlete = ({ navigation }) => {
    const [height, setHeight] = useState(0)
    const [favorite, setFavorite] = useState(false)
    const [barcode, setBarcode] = useState(false)

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
                        <View style={ Tailwind`w-full flex flex-row items-center justify-between mt-6` }>
                            <View style={ Tailwind`flex flex-row items-center` }>
                                <TouchableHighlight underlayColor={ "#10101010" } style={ Tailwind`rounded-full` } onPress={ () => navigation.goBack() }>
                                    <ArrowLeftIcon size={ 22 } style={ Tailwind`text-accent--black opacity-50` }/>
                                </TouchableHighlight>
                                <Text style={ Tailwind`font-rubik-semibold text-primary--red ml-4 text-base` }>
                                    Kelola Outlete
                                </Text>
                            </View>
                            <Image
                                source={ { uri: "https://images.unsplash.com/photo-1593085512500-5d55148d6f0d?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8Mnx8Y2FydG9vbnxlbnwwfHwwfHw%3D&auto=format&fit=crop&w=500&q=60" } }
                                resizeMode={ "contain" }
                                style={ Tailwind`w-11 h-11 rounded-full ml-5` }
                            />
                        </View>
                        <View style={ Tailwind`w-full flex flex-col bg-white mt-6 rounded-2xl` }>
                            <View style={ Tailwind`w-full p-6` }>
                                <View style={ Tailwind`w-24 h-24 rounded-md border-2 border-gray-300 bg-gray-200 self-center flex flex-col items-center justify-center` }>
                                    <Text style={ Tailwind`text-accent--black text-3xl` }>
                                        NP
                                    </Text>
                                </View>
                                <View style={ [Tailwind`w-10 h-10 rounded-full bg-primary--red flex flex-col items-center justify-center shadow-lg self-center z-50`, { transform: [{ translateY: -30 }, { translateX: 40 }] }] }>
                                    <CameraIcon size={ 22 } style={ Tailwind`text-white` }/>
                                </View>
                                <Text style={ Tailwind`font-rubik-semibold text-accent--black text-base mt-5` }>
                                    Informasi Outlet
                                </Text>
                                <TextInput
                                    placeholder="Nama Outlet"
                                    style={ Tailwind`text-sm text-accent--black tracking-wide w-full px-5 py-4 rounded-md bg-transparent border border-gray-200 mt-5` }
                                />
                                <TextInput
                                    placeholder="No.Handphone"
                                    style={ Tailwind`text-sm text-accent--black tracking-wide w-full px-5 py-4 rounded-md bg-transparent border border-gray-200 mt-3` }
                                />
                            </View>
                        </View>
                        <View style={ Tailwind`w-full p-6 bg-white rounded-2xl mt-3` }>
                            <Text style={ Tailwind`font-rubik-semibold text-accent--black text-base` }>
                                Alamat Outlet
                            </Text>
                            <TextInput
                                placeholder="Detail Alamat"
                                style={ Tailwind`text-sm text-accent--black tracking-wide w-full px-5 py-4 rounded-md bg-transparent border border-gray-200 mt-5` }
                            />
                            <TextInput
                                placeholder="Kelurahan"
                                style={ Tailwind`text-sm text-accent--black tracking-wide w-full px-5 py-4 rounded-md bg-transparent border border-gray-200 mt-3` }
                            />
                            <TextInput
                                placeholder="kode Pos"
                                style={ Tailwind`text-sm text-accent--black tracking-wide w-full px-5 py-4 rounded-md bg-transparent border border-gray-200 mt-3` }
                            />
                        </View>
                        <View style={ Tailwind`w-full p-6 bg-white rounded-2xl mt-3` }>
                            <Text style={ Tailwind`font-rubik-semibold text-accent--black text-base` }>
                                Lokasi Outlet
                            </Text>
                            <View style={ Tailwind`w-full flex flex-row items-center justify-between mt-5` }>
                                <View style={ Tailwind`flex flex-row items-center` }>
                                    <View style={ Tailwind`w-12 h-12 rounded-full bg-gray-100 flex flex-col items-center justify-center` }>
                                        <LocationMarkerIcon size={ 24 } style={ Tailwind`text-accent--black` }/>
                                    </View>
                                    <Text style={ Tailwind`font-rubik-regular text-accent--black text-sm ml-5` }>
                                        Pin Lokasi melalui peta
                                    </Text> 
                                </View>
                                <ChevronRightIcon size={ 24 } style={ Tailwind`text-accent--black` }/>
                            </View>
                            <TextInput
                                placeholder="Catatan Lokasi"
                                style={ Tailwind`text-sm text-accent--black tracking-wide w-full px-5 py-4 rounded-md bg-transparent border border-gray-200 mt-5` }
                            />
                        </View>
                        <View style={ Tailwind`w-full p-6 rounded-2xl mt-3 flex flex-col bg-white` }>
                            <View style={ Tailwind`w-full flex flex-row items-center justify-between` }>
                                <Text style={ Tailwind`font-rubik-semibold text-accent--black text-base` }>
                                    Pegawai
                                </Text>
                                <Text style={ Tailwind`font-rubik-regular text-primary--red text-base` }>
                                    Pilih Pegawai
                                </Text>
                            </View>
                            <View style={ Tailwind`w-full h-px my-5 bg-gray-200` }/>
                            <ButtonPrimary text={ "Simpan" }/>
                        </View>
                        <View style={ Tailwind`h-6` }/>
                    </ScrollView>
                </View>
            </SafeAreaView>
        </Fragment>
    )
}

export default AddOutlete