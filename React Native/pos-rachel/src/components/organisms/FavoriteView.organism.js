import React, { Fragment } from "react"
import { View, Text, Image, TouchableHighlight } from "react-native"
import { connect } from "react-redux"
import Tailwind from "../../libs/tailwind/Tailwind.lib"
import { PlusIcon } from "react-native-heroicons/solid"
import { useNavigation } from "@react-navigation/native"

const FavoriteView = ({ widthComponent }) => {
    const navigation = useNavigation()

    return (
        <Fragment>
            <View style={ [Tailwind`flex-grow flex flex-col items-center justify-center`, { width: widthComponent }] }>
                <Image
                    source={ require("../../assets/ilustrations/box.png") }
                    resizeMode={ "contain" }
                    style={ Tailwind`w-50 h-50` }
                />
                <Text style={ Tailwind`font-rubik-medium text-accent--black text-sm` }>
                    Belum Ada Produk
                </Text>
                <Text style={ Tailwind`font-rubik-regular text-accent--black text-xs mt-1 tracking-wide leading-relaxed text-center opacity-80` }>
                    Pilih "Tambah Produk" untuk menambahkan produk kamu ke dalam inventori.
                </Text>
                <TouchableHighlight underlayColor={ "#10101010" } style={ Tailwind`rounded-full mt-5` } onPress={ () => navigation.push("AddProduct") }>
                    <View style={ Tailwind`flex flex-row items-center` }>
                        <PlusIcon size={ 22 } style={ Tailwind`text-accent--black opacity-30 mr-2` }/>
                        <Text style={ Tailwind`font-rubik-medium text-primary--red text-xs` }>
                            Tambah Produk
                        </Text>
                    </View>
                </TouchableHighlight>
            </View>
        </Fragment>
    )
}

const mapStateToProps = (state) => {
    return {
        widthComponent : state.widthComponent
    }
}

export default connect(mapStateToProps, null)(FavoriteView)