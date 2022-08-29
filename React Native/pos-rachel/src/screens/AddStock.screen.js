import React, { Fragment, useState, useEffect } from "react"
import { Text, TouchableHighlight, View, SafeAreaView, TextInput, ScrollView, Dimensions } from "react-native"
import Tailwind from "../libs/tailwind/Tailwind.lib"
import { ArrowLeftIcon } from "react-native-heroicons/solid"
import ToggleSwitch from "toggle-switch-react-native"
import ButtonPrimary from "../components/molecules/ButtonPrimary.molecule"

const AddStock = ({ navigation }) => {
    const [height, setHeight] = useState(0)
    const [online, setOnline] = useState(false)
    const [offline, setOffline] = useState(false)

    useEffect(() => {
        setHeight(() => Dimensions.get("screen").height)

        Dimensions.addEventListener("change", () => {
            setHeight(() => Dimensions.get("screen").height)
        })
    }, [])

    return (
        <Fragment>
            <SafeAreaView>
                <View style={ [Tailwind`w-full flex flex-col bg-primary--red--20 px-6 pb-6`, { height }] }>
                    <ScrollView>
                        <View style={ Tailwind`flex flex-row items-cente my-6` }>
                            <TouchableHighlight underlayColor={ "#10101010" } style={ Tailwind`rounded-full` } onPress={ () => navigation.goBack() }>
                                <ArrowLeftIcon size={ 22 } style={ Tailwind`text-accent--black opacity-50` }/>
                            </TouchableHighlight>
                            <Text style={ Tailwind`font-rubik-semibold text-primary--red ml-4 text-base` }>
                                Kelola Stock
                            </Text>
                        </View>
                        <View style={ Tailwind`w-full flex flex-col bg-white rounded-2xl` }>
                            <View style={ Tailwind`w-full px-6 py-6` }>
                                <View style={ Tailwind`w-full flex flex-row items-center justify-between` }>
                                    <Text style={ Tailwind`font-bold text-accent--black text-base` }>
                                        Stok Toko Offline
                                    </Text>
                                    <ToggleSwitch
                                        isOn={ offline }
                                        onColor={ "red" }
                                        offColor={ "gray" }
                                        size={ "medium" }
                                        onToggle={ (isOn) => setOffline((value) => !value) }
                                    />
                                </View>
                                <TextInput
                                    placeholder="Stok Toko Offline"
                                    style={ Tailwind`text-sm text-accent--black tracking-wide w-full px-5 py-4 rounded-md ${ offline ? "bg-gray-100" : "bg-transparent" } border border-gray-200 mt-5` }
                                    editable={ offline }
                                />
                                <TextInput
                                    placeholder="Pilih Satuan Unit"
                                    style={ Tailwind`text-sm text-accent--black tracking-wide w-full px-5 py-4 rounded-md ${ offline ? "bg-gray-100" : "bg-transparent" } border border-gray-200 mt-3` }
                                    editable={ offline }
                                />
                                <TextInput
                                    placeholder="Minimun Stok"
                                    style={ Tailwind`text-sm text-accent--black tracking-wide w-full px-5 py-4 rounded-md ${ offline ? "bg-gray-100" : "bg-transparent" } border border-gray-200 mt-3` }
                                    editable={ offline }
                                />
                            </View>
                        </View>
                        <View style={ Tailwind`w-full px-6 py-6 mt-3 bg-white flex flex-col rounded-2xl` }>
                            <View style={ Tailwind`w-full flex flex-row items-center justify-between` }>
                                <View style={ Tailwind`flex flex-col` }>
                                    <Text style={ Tailwind`font-bold text-accent--black text-base` }>
                                        Stok Katalog Online
                                    </Text>
                                    <Text style={ Tailwind`text-xs text-accent--black opacity-80 mt-1` }>Alokasi stok untuk ditampilkan di Website Usaha.</Text>
                                </View>
                                <ToggleSwitch
                                    isOn={ online }
                                    onColor={ "red" }
                                    offColor={ "gray" }
                                    size={ "medium" }
                                    onToggle={ (isOn) => setOnline((value) => !value) }
                                />
                            </View>
                            <TextInput
                                placeholder="Stok Katalog Online"
                                style={ Tailwind`text-sm text-accent--black tracking-wide w-full px-5 py-4 rounded-md ${ online ? "bg-gray-100" : "bg-transparent" } border border-gray-200 mt-5` }
                                editable={ online }
                            />
                            <Text style={ Tailwind`text-xs text-accent--black opacity-80 mt-2` }>Stok akan berkurang jika terjual di Website Usaha.</Text>
                            <View style={ Tailwind`w-full mt-10` }>
                                <ButtonPrimary text={ "Simpan" }/>
                            </View>
                        </View>
                    </ScrollView>
                </View>
            </SafeAreaView>
        </Fragment>
    )
}

export default AddStock